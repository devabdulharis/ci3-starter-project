<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autocomplete_model extends CI_Model
{
    public function get_locations($keyword = '')
    {
        $this->db->select('jawaban AS lokasi');
        $this->db->from('bap_pelanggar_detail');
        $this->db->where('variabel', 'tkp');
        if (!empty($keyword)) {
            $this->db->like('LOWER(jawaban)', strtolower($keyword)); // Case-insensitive
        }
        $this->db->group_by('jawaban');
        $this->db->order_by('COUNT(jawaban)', 'DESC'); // Mengurutkan berdasarkan jumlah pelanggaran
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_locations_api($keyword = '')
    {
        $this->db->select('jawaban AS lokasi, COUNT(jawaban) AS jumlah, master_bap.jenis_bap');
        $this->db->from('bap_pelanggar_detail');
        $this->db->where('variabel', 'tkp');
        $this->db->join('master_bap', 'master_bap.id=id_master_bap');
        if (!empty($keyword)) {
            $this->db->like('LOWER(jawaban)', strtolower($keyword)); // Case-insensitive
        }
        $this->db->group_by('jawaban');
        $this->db->order_by('COUNT(jawaban)', 'DESC'); // Mengurutkan berdasarkan jumlah pelanggaran
        $query = $this->db->get();
        return $query->result_array();
    }

}