<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filemanager extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('File_model');
    }

    public function index() {
        $this->load->view('filemanager/v_file_list');
    }

    public function read_grid() {
        $files = $this->File_model->get_all_files();
    
        $data = [];
        foreach ($files as $file) {
            $data[] = [
                'id' => $file->id,
                'original_name' => $file->original_name,
                'description' => $file->description,
                'is_public' => $file->is_public,
            ];
        }
    
        echo json_encode(['data' => $data]);
    }    

    public function read() {
        $files = $this->File_model->get_all_files(); // ambil semua file
    
        $data = [];
        foreach ($files as $file) {
            $data[] = [
                'original_name' => $file->original_name,
                'description' => $file->description,
                'status' => $file->is_public ? '<span class="badge bg-success">Publik</span>' : '<span class="badge bg-secondary">Privat</span>',
                'aksi' => '
                    <a href="'.site_url('filemanager/download/' . $file->id).'" class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-download"></i> Download
                    </a>
                    <a href="javascript:void(0)" onclick="axiosGetDelete(\'filemanager/delete/'.$file->id.'\', \'ingin menghapus data '.$file->description.'\')" class="btn btn-sm btn-outline-danger">
                        <i class="ti ti-trash"></i> Hapus
                    </a>'
            ];
        }
    
        echo json_encode(['data' => $data]);
    }    

    public function public_read_grid() {
        $files = $this->File_model->get_all_by_status(1);
    
        $data = [];
        foreach ($files as $file) {
            $data[] = [
                'id' => $file->id,
                'original_name' => $file->original_name,
                'description' => $file->description,
                'is_public' => $file->is_public,
                'file_name' => $file->file_name
            ];
        }
    
        echo json_encode(['data' => $data]);
    }  

    public function public_read() {
        $files = $this->File_model->get_all_by_status(1); // ambil semua file
    
        $data = [];
        foreach ($files as $file) {
            $data[] = [
                'original_name' => $file->original_name,
                'description' => $file->description,
                'status' => $file->is_public ? '<span class="badge bg-success">Publik</span>' : '<span class="badge bg-secondary">Privat</span>',
                'aksi' => '
                    <a href="'.site_url('filemanager/public_download/' . $file->file_name).'" class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-download"></i> Download
                    </a>'
            ];
        }
    
        echo json_encode(['data' => $data]);
    }  

    public function add() {
        // Validasi input menggunakan form_validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
    
        if (empty($_FILES['userfile']['name'])) {
            echo json_encode(array('rc' => '01', 'data' => 'File harus dipilih.'));
            return;
        }
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('rc' => '01', 'data' => validation_errors()));
            return;
        }
    
        // Konfigurasi upload
        $config['upload_path']   = './assets/upload/arsip/';
        $config['allowed_types'] = '*'; // Sebaiknya dibatasi untuk alasan keamanan
        $config['encrypt_name']  = TRUE;
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('userfile')) {
            $upload_data = $this->upload->data();
            $is_public = $this->input->post('is_public') ? 1 : 0;
            $description = $this->input->post('description');
    
            $this->File_model->insert_file([
                'file_name' => $upload_data['file_name'],
                'original_name' => $upload_data['orig_name'],
                'is_public' => $is_public,
                'description' => $description
            ]);
    
            echo json_encode(array('rc' => '00', 'data' => 'File berhasil diupload'));
        } else {
            $err = $this->upload->display_errors('<span style="color:red;">', '</span>');
            echo json_encode(array('rc' => '01', 'data' => $err));
        }
    }
    

    public function download($id) {
        $file = $this->File_model->get_file($id);

        if (!$file) {
            show_404();
        }

        // If file is private, you can add session-based auth here
        if (!$file->is_public && !$this->auth->is_logged()) {
            show_error('Unauthorized access.');
        }

        $this->load->helper('download');
        $path = FCPATH . './assets/upload/arsip/' . $file->file_name;

        if (file_exists($path)) {
            force_download($file->original_name, file_get_contents($path));
        } else {
            show_error('File not found.');
        }
    }

    public function public_download($filename) {
        $file = $this->File_model->get_file_name($filename);

        if (!$file) {
            show_404();
        }

        // If file is private, you can add session-based auth here
        if (!$file->is_public && !$this->auth->is_logged()) {
            show_error('Unauthorized access.');
        }

        $this->load->helper('download');
        $path = FCPATH . './assets/upload/arsip/' . $file->file_name;

        if (file_exists($path)) {
            force_download($file->original_name, file_get_contents($path));
        } else {
            show_error('File not found.');
        }
    }

    public function delete($id) {
        $file = $this->File_model->get_file($id);
    
        if (!$file) {
            echo json_encode(['rc' => '01', 'message' => 'File tidak ditemukan.']);
            return;
        }
    
        // Cek hak akses jika perlu, misal:
        if (!$this->auth->can('delete-filemanager')) {
            echo json_encode(['rc' => '02', 'message' => 'Unauthorized']);
            return;
        }
    
        $path = FCPATH . 'assets/upload/arsip/' . $file->file_name;
    
        // Hapus file fisik jika ada
        if (file_exists($path)) {
            unlink($path);
        }
    
        // Hapus data di database
        $this->File_model->delete_file($id);
    
        echo json_encode(['rc' => '00', 'message' => 'File berhasil dihapus.']);
    }
    
}
