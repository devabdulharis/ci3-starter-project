<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('datatables/User_datatables','user_dt'); 
        $this->auth->only(['read-user','add-user','delete-user']);       
    }

    public function profile() {
        $this->load->view('pengguna/v_profile_user');
    }
	
	public function read()
	{
        $data['roles'] = $this->Auth_model->getRoles();
		$this->load->view('pengguna/v_user_list', $data);
	}

    public function delete($id) {
        if($this->auth->api_access('delete-user')) {
            if(!is_null($id)) {
                if($this->User_model->delete($id)) {
                    echo json_encode(array('rc'=> '00', 'data'=>'Data berhasil dihapus'));
                }else{
                    echo json_encode(array('rc'=> '99', 'data'=>'Data gagal dihapus'));    
                }
            }else{
                echo json_encode(array('rc'=> '99', 'data'=>'Bad Request'));
            }
        }else{
            echo json_encode(array('rc'=> '99', 'data'=> $this->auth->getMessageError('permission_denied')));
        }
    }

    public function find($id) {
        if(!is_null($id)) {
            $data = $this->User_model->find($id);
            if(!is_null($data)) {
                $data->role = $this->User_model->userWiseRoles($id)[0];
                echo json_encode(array('rc'=> '00', 'data'=> $data));
            }else{
                echo json_encode(array('rc'=> '99', 'data'=> 'Data tidak ditemukan'));    
            }
        }else{
            echo json_encode(array('rc'=> '99', 'data'=>'Bad Request'));
        }    
    }

    public function getUsers()
    {
        $list = $this->user_dt->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->username;
            $row[] = $user->first_name;
            $row[] = $user->last_name;
            $row[] = $user->email_address;

            // Mengubah status menjadi teks
            $status = "Unknown";
            switch ($user->status) {
                case 0:
                    $status = "Deactivated";
                    break;
                case 1:
                    $status = "Activated";
                    break;
                case 2:
                    $status = "Hold/Ban";
                    break;
            }
            $row[] = $status;
            $row[] = '<button class="btn btn-sm btn-danger" onclick="axiosGetDelete(\'user/delete/'.$user->id.'\',\'Menghapus data '.$user->first_name.'\')">
            <i class="fa fa-trash"></i></button> | <button class="btn btn-sm btn-info" data-pc-animate="fade-in-scale" type="button" data-bs-toggle="modal" data-bs-target="#animateModal" onclick="showPopupUpdate(\''.$user->id.'\')"><i class="fa fa-edit"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_dt->count_all(),
            "recordsFiltered" => $this->user_dt->count_filtered(),
            "data" => $data,
        );
        // Output dalam format JSON
        echo json_encode($output);
    }

    public function add() {
        // Set validation rules
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Panggilan', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
        if(!empty($data['id'])) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }

        $output = NULL;
        if ($this->form_validation->run() == FALSE) {
            $output = array(
                "rc"=>"99", 
                "data" => "Harap lengkapi form dengan benar!"
            );
        }else {
            $data = $this->input->post();
            if(empty($data['id'])) { //insert
                $data['username'] = $this->input->post('email_address');
                $user = $this->User_model->findByEmail($data['email_address']);
                if($user == NULL) {
                    if($this->auth->api_access('add-user')) {
                        if($this->User_model->add($data)) {
                            $output = array(
                                "rc"=>"00", 
                                "data" => "Data berhasil diinsert"
                            );
                        }else{
                            $output = array(
                                "rc"=>"99", 
                                "data" => "Data gagal diinsert"
                            );
                        }
                    }else{
                        $output = array(
                            "rc"=>"99", 
                            "data" => $this->auth->getMessageError('permission_denied')
                        );
                    }
                }else{
                    $output = array(
                        "rc"=>"99", 
                        "data" => "Email sudah digunakan"
                    );
                }
            }else{ //update
                if($this->auth->api_access('update-user')) {
                    if(empty($data['password'])) { //kalo kosong? pake passwd lama
                        //unset passwd karna ga usah diubah
                        unset($data['password']);
                    }else{
                        //hash passwd karna user isi passwdnya
                        $data['password'] = password_hash($data["password"], PASSWORD_BCRYPT);
                    }
                    if($this->User_model->edit($data)) {
                        $output = array(
                            "rc"=>"00", 
                            "data" => "Data berhasil diupdate"
                        );
                    }else{
                        $output = array(
                            "rc"=>"99", 
                            "data" => "Data gagal diupdate"
                        );
                    }
                }else{
                    $output = array(
                        "rc"=>"99", 
                        "data" => $this->auth->getMessageError('permission_denied')
                    );
                }
            }
        }
        echo json_encode($output);
    }    
}