<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File_model extends CI_Model {
    public function insert_file($data) {
        return $this->db->insert('files', $data);
    }

    public function get_file($id) {
        return $this->db->get_where('files', ['id' => $id])->row();
    }

    public function get_file_name($id) {
        return $this->db->get_where('files', ['file_name' => $id])->row();
    }

    public function get_all_files() {
        return $this->db->get('files')->result();
    }

    public function get_all_by_status($status) {
        return $this->db->get_where('files', array('is_public' => $status))->result();
    }

    public function delete_file($id) {
        return $this->db->delete('files', ['id' => $id]);
    }    
}
