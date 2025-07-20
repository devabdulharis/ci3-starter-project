<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal) {
        $nama_hari = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );

        $nama_bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $tahun = substr($tanggal, 0, 4);
        $bulan = substr($tanggal, 5, 2);
        $tanggal = substr($tanggal, 8, 2);

        $tanggal_fix = $nama_hari[date('w', strtotime($tanggal.'-'.$bulan.'-'.$tahun))].', '.$tanggal.' '.$nama_bulan[(int)$bulan-1].' '.$tahun;

        return $tanggal_fix;
    }
}

if (!function_exists('format_tanggal')) {
    function format_tanggal($tanggal) {
        return $tanggal = substr($tanggal, 8, 2);
    }
}

if (!function_exists('format_bulan')) {
    function format_bulan($tanggal) {
        $nama_hari = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );

        $nama_bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        
        $bulan = substr($tanggal, 5, 2);

        return $nama_bulan[(int)$bulan-1];
    }
}

function angkaTerbilang($x){
	$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "sebelas");
	if ($x < 12)
		return " " . $abil[$x];
	elseif ($x < 20)
		return angkaTerbilang($x - 10) . " Belas";
	elseif ($x < 100)
		return angkaTerbilang($x / 10) . " Puluh" . angkaTerbilang($x % 10);
	elseif ($x < 200)
		return " Seratus" . angkaTerbilang($x - 100);
	elseif ($x < 1000)
		return angkaTerbilang($x / 100) . " Ratus" . angkaTerbilang($x % 100);
	elseif ($x < 2000)
		return " Seribu" . angkaTerbilang($x - 1000);
	elseif ($x < 1000000)
		return angkaTerbilang($x / 1000) . " Ribu" . angkaTerbilang($x % 1000);
	elseif ($x < 1000000000)
		return angkaTerbilang($x / 1000000) . " Juta" . angkaTerbilang($x % 1000000);
}

if (!function_exists('format_tahun')) {
    function format_tahun($tanggal) {
        $tahun = substr($tanggal, 0, 4);
        return angkaTerbilang($tahun);
    }
}

if (!function_exists('format_jk')) {
    function format_jk($jk) {
        if($jk == "P") {
            return "Perempuan";
        }
        return "Laki-Laki";
    }
}


if (!function_exists('format_hari')) {
    function format_hari($tanggal) {
        $nama_hari = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );

        $tahun = substr($tanggal, 0, 4);
        $bulan = substr($tanggal, 5, 2);
        $tanggal = substr($tanggal, 8, 2);

        return $nama_hari[date('w', strtotime($tanggal.'-'.$bulan.'-'.$tahun))];
    }
}

if (!function_exists('format_indonesia')) {
    function format_indonesia($tanggal) {
        $nama_bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $tahun = substr($tanggal, 0, 4);
        $bulan = substr($tanggal, 5, 2);
        $tanggal = substr($tanggal, 8, 2);

        $tanggal_fix = $tanggal.' '.$nama_bulan[(int)$bulan-1].' '.$tahun;

        return $tanggal_fix;
    }
}

if (!function_exists('hitung_usia')) {
    function hitung_usia($tanggal_lahir) {
        // Menghitung usia berdasarkan tanggal lahir
        $tanggal_lahir = new DateTime($tanggal_lahir);
        $sekarang = new DateTime();
        $usia = $sekarang->diff($tanggal_lahir);
        
        return $usia->y;
    }
}

if (!function_exists('calculate_age')) {
    function calculate_age($birthdate) {
        // Convert the date string to a DateTime object
        $birthdate = new DateTime($birthdate);
        $today = new DateTime('today');
        // Calculate the age
        $age = $birthdate->diff($today)->y;
        return $age;
    }
}