<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Linmas_model', 'linmas_model');
        $this->load->model('Surat_model', 'surat_model');
        $this->load->model('Kegiatan_model', 'kegiatan_model');
        $this->load->model('Perda_model', 'perda_model');
        $this->load->model('Siskamling_model', 'siskamling_model');
        $this->load->model('Sarana_model', 'sarana_model');
        $this->load->model('Sop_model', 'sop_model');
        $this->load->model('Pegawai_model', 'pegawai_model');
    }

    // Fungsi untuk menghasilkan array warna berdasarkan jumlah label
    private function generate_colors($count)
    {
        $colors = ['#3EC9D6', '#FFC107', '#00C853']; // Warna default
        $generated_colors = array_slice($colors, 0, $count);
        return $generated_colors;
    }

    public function index()
    {
        //$data['pegawai'] = $this->pegawai_model->get_pegawai_by_kecamatan();
        $data['linmas'] = $this->linmas_model->get_linmas_by_kecamatan();
        $data['siskamling'] = $this->siskamling_model->get_siskamling_by_kecamatan();
        $data['status_counts'] = $this->pegawai_model->get_status_count();
        $data['dataSuratMasuk'] = $this->surat_model->surat_counts();
        $this->load->view('v_landing', $data);
    }

    public function dokumen()
    {
        $this->load->view('filemanager/v_page_file');
    }

    public function get_pegawai_by_kecamatan()
    {
        header('Content-Type: application/json');
        echo json_encode($this->pegawai_model->get_pegawai_by_kecamatan());
    }

    public function get_kabupaten_json()
    {
        $path = FCPATH . 'assets/json/kabupaten_cirebon.json';

        if (!file_exists($path)) {
            show_404();
        }

        header('Content-Type: application/json');
        echo file_get_contents($path);
    }
}
