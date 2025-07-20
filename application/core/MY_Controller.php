<?php

use AzharLihan\CI3Modules\BaseLoader;

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		define('APP_NAME', 'BUMDesQ'); // Nama aplikasi
		define('APP_DESC', 'BUMDes Quick Rseporting'); // Deskripsi singkat
		define('APP_COPYRIGHT', 'PEMDES DESA GUMULUNG LEBAK'); // Pihak yang memiliki hak cipta
		define('APP_VER', '0.1-Development'); // Versi aplikasi

		// Metadata panjang, bisa ditampilkan di halaman utama atau sebagai deskripsi SEO
		define(
			'APP_META',
			APP_NAME . ' adalah platform pelaporan keuangan dan manajemen operasional BUMDes yang dirancang untuk meningkatkan transparansi, akuntabilitas, dan efisiensi pelaporan unit usaha milik desa. ' .
				'Sistem ini membantu pengelola desa dalam menyusun laporan keuangan, merekap transaksi harian, dan menghasilkan laporan periodik secara otomatis. ' .
				'Dengan antarmuka yang mudah digunakan dan fitur yang lengkap, ' . APP_NAME . ' menjadi solusi digital modern bagi BUMDes di Indonesia.'
		);

		// Kata kunci SEO
		define('APP_KEYWORDS', 'BUMDes, BUMDesQ, Sistem Informasi Desa, Pelaporan Keuangan BUMDes, Desa Digital, BUMDes Gumulung Lebak, Quick Reporting');

		// Nama pengembang, bisa juga ditampilkan di footer
		define('APP_DEV_NAME', 'Dikembangkan oleh Tim BUMDesQ - Gumulung Lebak Digital Solutions');

		// Inisialisasi Loader
		$this->load = new BaseLoader;
	}
}
