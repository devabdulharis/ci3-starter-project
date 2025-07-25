<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User authentication library. 
 * 
 * @author  Abdullah Ubayed Tanvir
 */

class Auth
{
    /**
     * Stores all the error message.
     * 
     * @var     _error
     */
    private $_error;

    /**
     * Stores all other message.
     * 
     * @var     _message
     */
    private $_message;

    /**
     * Stores users info while authenticating.
     * 
     * @var     array
     */
    private $_user;

    /**
     * Maximum size of password in bytes.
     * 
     * @var     int
     */
    private $_max_password_size = 4096;
    /**
     * Loads neccessary model, libraries and helpers.
     * 
     * @method  __construct
     * @param
     * @return  void
     */
    public function __construct()
    {
        // validate compatibiliry with the system
        $this->_validate_compatibility();

        // load config file
        $this->config->load('auth');

        // load language file for messages
        $this->lang->load('auth', 'english');

        // load authentication model
        $this->load->model('Auth_model', 'auth_model');

        // load required libraries
        $this->load->library(['session', 'user_agent', 'encryption']);

        // load required helpers
        $this->load->helper(['cookie', 'string', 'auth']);

        // log message to debugger
        log_message('debug', 'Authentication library initialized.');
    }

    /**
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * @method  __get
     * @param   string $var
     * @return  mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    /**
     * Validates if this library is compatible with the system or not.
     * 
     * @method  _validate_compatibility
     * @param   
     * @return  void
     */
    private function _validate_compatibility()
    {
        // Check if the current version of codeigniter is compatible
        if (substr(CI_VERSION, 0, 1) !== '3') {
            show_error($this->lang->line('auth_ci_version_mismatch'));
        }

        // password_hash functions is required for encrytion of user password
        if (!function_exists('password_hash')) {
            show_error($this->lang->line('auth_hashing_unavailable'));
        }

        // password_verify functions is required for the verification of the encrypted password
        if (!function_exists('password_verify')) {
            show_error($this->lang->line('auth_pass_verify_unavailable'));
        }
    }

    /**
     * Validates provided informations and creates login session.
     * 
     * @method  validate
     * @param   string  Valid email address
     *          string  Users password
     *          bool    Whether to remember the session or not
     * @return  bool
     */

    public function validate($email_addr, $password, $remember)
    {
        // Check if credentials are empty
        if (empty($email_addr) || empty($password)) {
            $this->_set_error('auth_empty_credentials');
            return FALSE;
        }

        // Determine the length of the password. Long password may pose DDOS issue
        if (strlen($password) > $this->_max_password_size) {
            $this->_set_error('auth_lengthy_password');
            return FALSE;
        }

        // get user information
        $this->_user = $this->auth_model->getUser($email_addr);

        // check if anything returned
        if (is_null($this->_user)) {
            $this->_set_error('auth_user_not_found');
            // increase login attempt count
            $this->auth_model->increase_login_attempt();

            return FALSE;
        }

        // check if the user attemted maximum login request
        if ($this->auth_model->login_attempt_exceeded($this->_user->id)) {
            $this->_set_error('auth_login_exceeded');

            return FALSE;
        }

        // check if the provided password matches
        if (!$this->_password_matches($password, $this->_user->password)) {
            $this->auth_model->increase_login_attempt($this->_user->id);

            $this->_set_error('auth_password_mismatch');

            return FALSE;
        }

        // check if the user is active
        if ((int) $this->_user->status !== 1) {
            $this->_set_error('auth_inactive_account_' . $this->_user->status);

            return FALSE;
        }

        // create a login session
        $this->setSession((int) $remember);

        // clear all login attempt
        $this->auth_model->clear_login_attempts($this->_user->id);

        // set success message
        $this->_set_message('auth_login_successful');

        return TRUE;
    }

    /**
     * Validates if the submited password matches with the saved password using
     * PHP's build in 'password_verify' function.
     * More info at - https://www.php.net/manual/en/function.password-verify.php
     * 
     * @method  _password_matches
     * @param   string  -   User provided password
     *          string  -   The password stored in the database
     * @return  bool
     */

    private function _password_matches($match, $with)
    {
        return password_verify($match, $with);
    }

    /**
     * Stores session data if submitted credentials are valid.
     * 
     * @method  setSession
     * @param   object  User informations as an object
     *          string  Long encrypted to
     * @return  bool
     */

    private function setSession($remember)
    {
        // generate random encrypted key for validation
        $enkey = $this->_generate_enckey();

        if ($remember === 1) {
            // store encrypted user info in cookie
            set_cookie(array(
                'name' => $this->config->item('auth_cookie_id'),
                'value' => $this->_user->enc_key,
                'expire' => $this->config->item('auth_cookie_expiry'),
                'httponly' => TRUE
            ));

            // store encrypted key in cookie
            set_cookie(array(
                'name' => $this->config->item('auth_cookie_key'),
                'value' => $enkey,
                'expire' => $this->config->item('auth_cookie_expiry'),
                'httponly' => TRUE
            ));

            set_cookie(array(
                'name' => $this->config->item('auth_cookie_key'),
                'value' => $enkey,
                'expire' => $this->config->item('auth_cookie_expiry'),
                'httponly' => TRUE
            ));

            $id_role = $this->auth_model->userRoleId($this->_user->id);

            set_cookie(array(
                'name' => $this->config->item('auth_role_key'),
                'value' => $id_role,
                'expire' => $this->config->item('auth_cookie_expiry'),
                'httponly' => TRUE
            ));

            $this->session->set_userdata($this->config->item('auth_role_key'), $id_role);
        } else {
            // set what will be stored in the session
            $id_role = $this->auth_model->userRoleId($this->_user->id);
            $data = array(
                $this->config->item('auth_session_id') => $this->_user->enc_key,
                $this->config->item('auth_session_enkey') => $enkey,
                $this->config->item('auth_role_key') => $id_role
            );

            // store data in the session
            $this->session->set_userdata($data);
        }

        log_message('error', 'Session: ' . json_encode($this->session->userdata()));

        // add a new row in login history table and return the result
        return $this->auth_model->update_last_login($this->_user, $enkey, $remember);
    }

    /**
     * Generates random key, encrypts the value and then returns it.
     * This key is used in 'auth_model's remember_user() method.
     * 
     * @method  _generate_enckey
     * @param   
     * @return  string
     */
    private function _generate_enckey()
    {
        // encrypt user id and email so that nobody gets the user information
        $this->_user->enc_key = $this->encryption->encrypt($this->_user->id . '-' . $this->_user->email_address);

        // use codeigniters string helper to generate random key
        $string = random_string('alnum', 16);

        log_message('error', $string);

        // encrypt it again just for nothing and then return the key.
        return $this->encryption->encrypt($string);
    }

    /**
     * Determines if a user is logged in or not.
     * 
     * @method  is_logged
     * @param   
     * @return  bool
     */

    public function is_logged()
    {
        // set a variable to determine how to validate authentication data
        $validate_using = NULL;
        $id_role = NULL;

        if (
            get_cookie($this->config->item('auth_cookie_id'), TRUE)
            && get_cookie($this->config->item('auth_cookie_key'), TRUE)
        ) {
            // store cookie informations in variables
            $encryptedUserIDs = get_cookie($this->config->item('auth_cookie_id'), TRUE);
            $enckey = get_cookie($this->config->item('auth_cookie_key'), TRUE);
            $id_role = get_cookie($this->config->item('auth_role_key'), TRUE);
            $validate_using = 'cookie';
        } else {
            // store session informations in variables
            $encryptedUserIDs = $this->session->userdata($this->config->item('auth_session_id'));
            $enckey = $this->session->userdata($this->config->item('auth_session_enkey'));
            $id_role = $this->session->userdata($this->config->item('auth_role_key'));
            $validate_using = 'session';
        }

        // check if any data is available
        if (empty($encryptedUserIDs) || empty($enckey)) {
            return FALSE;
        }

        // decrypt user IDs
        $userIDs = $this->encryption->decrypt($encryptedUserIDs);

        $userArray = explode('-', $userIDs);

        log_message('error', 'Validate Using: ' . $validate_using);

        // return status
        return $this->auth_model->check_session($userArray[0], $userArray[1], $enckey, $validate_using, $id_role);
    }

    /**
     * Fetches authorized users data.
     * 
     * @method  logout
     * @param   array   Users table column names to select.
     * @return  array
     */

    public function getUserData($columns = array())
    {
        if (
            get_cookie($this->config->item('auth_cookie_id'), TRUE)
            && get_cookie($this->config->item('auth_cookie_key'), TRUE)
        ) {
            // store cookie informations in variables
            $encryptedUserIDs = get_cookie($this->config->item('auth_cookie_id'), TRUE);
            $enckey = get_cookie($this->config->item('auth_cookie_key'), TRUE);
        } else {
            // store session informations in variables
            $encryptedUserIDs = $this->session->userdata($this->config->item('auth_session_id'));
            $enckey = $this->session->userdata($this->config->item('auth_session_enkey'));
        }

        // check if any data is available
        if (empty($encryptedUserIDs) || empty($enckey)) {
            log_message('error', 'Data not avaliable');
            return FALSE;
        }

        // decrypt user IDs
        $userIDs = $this->encryption->decrypt($encryptedUserIDs);

        $userArray = explode('-', $userIDs);
        log_message('error', 'Data avaliable');
        // fetch and return user data
        return $this->auth_model->getByID($userArray[0], $userArray[1], $columns);
    }

    /**
     * Logs an user out. On other words, it destroys session login data,
     * deletes cookie session data and deletes user log from database.
     * 
     * @method  logout
     * @param   
     * @return  bool
     */

    public function logout()
    {
        if (
            get_cookie($this->config->item('auth_cookie_id'), TRUE)
            && get_cookie($this->config->item('auth_cookie_key'), TRUE)
        ) {
            // store cookie informations in variables
            $encryptedUserIDs = get_cookie($this->config->item('auth_cookie_id'), TRUE);
            $enckey = get_cookie($this->config->item('auth_cookie_key'), TRUE);
        } else {
            // store session informations in variables
            $encryptedUserIDs = $this->session->userdata($this->config->item('auth_session_id'));
            $enckey = $this->session->userdata($this->config->item('auth_session_enkey'));
        }

        // check if any data is available
        if (empty($encryptedUserIDs) || empty($enckey)) {
            $this->_set_message('auth_already_logged_out');

            return TRUE;
        }

        // decrypt user IDs
        $userIDs = $this->encryption->decrypt($encryptedUserIDs);

        $userArray = explode('-', $userIDs);

        // delete user log
        if (!$this->auth_model->disable_session($userArray[0], $enckey)) {
            $this->_set_error('auth_log_delete_failed');
            return FALSE;
        }

        // delete authentication cookie
        $this->_delete_auth_cookie();

        // Destroy the session
        $this->session->sess_destroy();

        // Set success message
        $this->_set_message('auth_logout_successful');

        return TRUE;
    }

    /**
     * Deletes authentication cookie data.
     * 
     * @method  _delete_auth_cookie
     * @param   
     * @return  bool
     */

    private function _delete_auth_cookie()
    {
        // delete authentication user iformations from cookie if available
        if (get_cookie($this->config->item('auth_cookie_id'))) {
            delete_cookie($this->config->item('auth_cookie_id'));
        }

        // delete authentication encrypted key from cookie if available
        if (get_cookie($this->config->item('auth_cookie_key'))) {
            delete_cookie($this->config->item('auth_cookie_key'));
        }

        if (get_cookie($this->config->item('auth_role_key'))) {
            delete_cookie($this->config->item('auth_cookie_key'));
        }

        return TRUE;
    }

    /**
     * Setter for authentication error messages.
     * 
     * @method  _set_error
     * @param   string  -   Language message item key or the message.
     * @return  NULL
     */

    private function _set_error($error)
    {
        // set error message in $_error property
        $this->_error = $error;

        return;
    }

    /**
     * Getter for authentication error messages.
     * 
     * @method  getError
     * @param
     * @return  string
     */

    public function getError()
    {
        // check if any error message available.
        if (!is_null($this->_error)) {
            // return the message
            return $this->lang->line($this->_error) ? $this->lang->line($this->_error) : $this->_error;
        }

        // return nothing if previous condition does not apply
        return NULL;
    }

    /**
     * Setter for authentication success messages
     * 
     * @method  _set_message
     * @param   string  -   Language message item key or the message.
     * @return  NULL
     */

    private function _set_message($message)
    {
        // set message in $_message property
        $this->_message = $message;

        return;
    }

    /**
     * Getter for authentication success messages.
     * 
     * @method  getMessage
     * @param
     * @return  string
     */

    public function getMessage()
    {
        // check if any error message available.
        if (!is_null($this->_message)) {
            // return the message
            return $this->lang->line($this->_message) ? $this->lang->line($this->_message) : $this->_message;
        }

        // return nothing if previous condition does not apply
        return NULL;
    }

    public function getMessageError($lineName)
    {
        return $this->lang->line($lineName);
    }

    public function authenticate()
    {
        if (!$this->auth->is_logged()) {
            return redirect('login');
        }

        return true;
    }

    public function check($methods = 0)
    {
        if (is_array($methods) && count(is_array($methods))) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->uri->segment(2)) ? "index" : $this->uri->segment(2))) {
                    return $this->authenticate();
                }
            }
        }
        return $this->authenticate();
    }



    /**
     * Determine if the current user is authenticated for specific methods.
     *
     * @param array $methods
     * @return bool
     */
    public function only($methods = array())
    {
        if (is_array($methods) && count($methods)) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->uri->segment(2)) ? "index" : $this->uri->segment(2))) {
                    return $this->route_access();
                }
            }
        }

        return true;
    }

    /**
     * Determine if the current user is authenticated except specific methods.
     *
     * @param array $methods
     * @return bool
     */
    public function except($methods = array())
    {
        if (is_array($methods) && count(is_array($methods))) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->uri->segment(2)) ? "index" : $this->uri->segment(2))) {
                    return true;
                }
            }
        }

        return $this->route_access();
    }

    /**
     * Determine if the current user is authenticated to view the route/url
     *
     * @return bool|void
     */
    public function route_access()
    {
        $this->check();

        $routeName = (is_null($this->uri->segment(2)) ? "index" : $this->uri->segment(2)) . "-" . $this->uri->segment(1);

        if ($this->uri->segment(1) == 'dashboard')
            return true;

        if ($this->can($routeName))
            return true;

        return redirect('exceptions/custom_404', 'refresh');
    }

    public function api_access($endpoint)
    {
        if ($this->can($endpoint))
            return true;

        return false;
    }

    /**
     * Checks if the current user has a role by its name.
     *
     * @param $roles
     * @param bool $requireAll
     * @return bool
     */

    public function userWiseRoles()
    {
        return $this->auth_model->userWiseRoles($this->getUserData()->id);
    }

    public function hasRole($roles, $requireAll = false)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->checkRole($role) && !$requireAll)
                    return true;
                elseif (!$this->checkRole($role) && $requireAll) {
                    return false;
                }
            }
        } else {
            return $this->checkRole($roles);
        }
        // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
        // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
        // Return the value of $requireAll;
        return $requireAll;
    }

    /**
     * Check current user has specific role
     *
     * @param $role
     * @return bool
     */

    public function getRoleUser()
    {
        return $this->auth_model->findRoleName($this->getUserData()->id);
    }

    public function checkRole($role)
    {
        return in_array($role, $this->auth_model->userRoles($this->getUserData()->id));
    }

    /**
     * Check if current user has a permission by its name.
     *
     * @param $permissions
     * @param bool $requireAll
     * @return bool
     */
    public function can($permissions, $requireAll = false)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->checkPermission($permission) && !$requireAll)
                    return true;
                elseif (!$this->checkPermission($permission) && $requireAll) {
                    return false;
                }
            }
        } else {
            return $this->checkPermission($permissions);
        }
        // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
        // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
        // Return the value of $requireAll;
        return $requireAll;
    }

    /**
     * Check current user has specific permission
     *
     * @param $permission
     * @return bool
     */
    public function checkPermission($permission)
    {
        $this->authenticate();
        return in_array($permission, $this->auth_model->userPermissions($this->getUserData()->id));
    }

    public function pageActive($controller)
    {
        if ($this->uri->segment(1) == $controller) {
            echo "active";
        }
    }

}


/* End of file */