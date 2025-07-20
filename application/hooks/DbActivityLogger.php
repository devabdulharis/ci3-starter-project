<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DbActivityLogger
{

    private $CI;
    private $allowed_tables = []; // Hanya tabel ini yang akan dilog

    public function __construct()
    {
        $this->CI = &get_instance();
        if (!$this->CI) {
            log_message('error', 'DbActivityLogger: get_instance() gagal');
            return;
        }

        $this->CI->load->database();
        $this->CI->load->library('session');
    }

    public function logQuery()
    {
        // Pastikan queries ada sebelum memanggil end()
        if (!isset($this->CI->db->queries) || !is_array($this->CI->db->queries)) {
            log_message('error', 'DbActivityLogger: db->queries tidak valid');
            return;
        }

        $query = end($this->CI->db->queries);
        if (!$query) {
            log_message('error', 'DbActivityLogger: Query kosong atau tidak ditemukan');
            return;
        }

        $user_id = isset($this->CI->session) ? ($this->CI->auth->getUserData()->id ?? 0) : 0;
        $ip_address = $this->CI->input->ip_address();
        $user_agent = $this->CI->input->user_agent();

        // Cek apakah query berisi INSERT, UPDATE, atau DELETE dan ambil nama tabelnya
        if (preg_match('/(?:INSERT INTO|UPDATE|DELETE FROM)\s+`?(\w+)`?/i', $query, $table_match)) {
            $table_name = $table_match[1];
        } else {
            log_message('error', 'DbActivityLogger: gagal menangkap nama tabel dari query: ' . $query);
            return;
        }

        // Cek apakah tabel ada di daftar allowed_tables
        if (!in_array($table_name, $this->allowed_tables)) {
            log_message('error', 'DbActivityLogger: tabel ' . $table_name . ' tidak terdaftar with query ' . $query);
            return; // Lewati logging jika tabel tidak ada dalam daftar
        }

        // Ambil record ID jika tersedia
        $record_id = 0;

        // Tangkap ID dari kondisi WHERE (contoh: WHERE id = 123 atau WHERE id IN (1,2,3))
        if (preg_match('/WHERE\s+.*?\bid\s*=\s*([0-9]+)/i', $query, $id_match)) {
            $record_id = $id_match[1];
        } elseif (preg_match('/WHERE\s+.*?\bid\s+IN\s*\(([\d,\s]+)\)/i', $query, $id_match)) {
            $record_id = $id_match[1]; // Bisa berupa "1,2,3" (list ID)
        }

        // Jika masih kosong dan query adalah INSERT, gunakan insert_id()
        if ($record_id == 0 && stripos($query, 'INSERT INTO') !== false) {
            $record_id = $this->CI->db->insert_id();
        }

        // Simpan ke tabel log
        $log_data = [
            'user_id'    => $user_id,
            'action'     => strtoupper(explode(' ', trim($query))[0]), // INSERT, UPDATE, DELETE
            'table_name' => $table_name,
            'record_id'  => $record_id,
            'description' => $query,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent
        ];
        $this->CI->db->insert('user_activity_log', $log_data);
    }
}
