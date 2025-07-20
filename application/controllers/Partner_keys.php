<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_keys extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Partner_key_model');
        $this->load->library('form_validation');
    }

    /**
     * AJAX: Get list of partners with keys
     */
    public function ajax_list() {
        $partners = $this->Partner_key_model->get_all_partners_with_keys();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => $partners]));
    }

    /**
     * AJAX: Get single partner data
     */
    public function ajax_get($user_id) {
        $partner = $this->Partner_key_model->get_partner_with_key($user_id);
        
        if ($partner) {
            $response = ['status' => true, 'data' => $partner];
        } else {
            $response = ['status' => false, 'message' => 'Partner not found'];
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * AJAX: Create new partner with key
     */
    public function ajax_create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        
        $response = ['status' => false, 'message' => 'Validation failed'];
        
        if ($this->form_validation->run()) {
            $partner_data = [
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'description' => $this->input->post('description')
            ];

            $key_data = null;
            if ($this->input->post('generate_key')) {
                $key_data = [
                    'key' => $this->Partner_key_model->generate_key(),
                    'ip_addresses' => $this->input->post('ip_addresses')
                ];
                $response['generated_key'] = $key_data['key'];
            }

            $user_id = $this->Partner_key_model->create_partner_with_key($partner_data, $key_data);
            
            if ($user_id) {
                $response = ['status' => true, 'message' => 'Partner created successfully'];
            } else {
                $response = ['status' => false, 'message' => 'Failed to create partner'];
            }
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * AJAX: Update partner and key
     */
    public function ajax_update() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('user_id', 'User ID', 'required|numeric');
        
        $response = ['status' => false, 'message' => 'Validation failed'];
        
        if ($this->form_validation->run()) {
            $user_id = $this->input->post('user_id');
            $partner_data = [
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'email' => $this->input->post('email'),
                'description' => $this->input->post('description')
            ];

            $key_data = null;
            if ($this->input->post('generate_key')) {
                $key_data = [
                    'ip_addresses' => $this->input->post('ip_addresses')
                ];
            }

            $success = $this->Partner_key_model->update_partner_with_key($user_id, $partner_data, $key_data);
            
            if ($success) {
                $response = ['status' => true, 'message' => 'Partner updated successfully'];
            } else {
                $response = ['status' => false, 'message' => 'Failed to update partner'];
            }
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * AJAX: Delete partner and key
     */
    public function ajax_delete($user_id) {
        $success = $this->Partner_key_model->delete_partner_with_key($user_id);
        
        if ($success) {
            $response = ['status' => true, 'message' => 'Partner deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete partner'];
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}