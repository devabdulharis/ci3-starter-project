<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel_lib {
    protected $spreadsheet;

    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
    }

    public function addData($data) {
        $sheet = $this->spreadsheet->getActiveSheet();
        foreach ($data as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
        return $this;
    }

    public function download($filename) {
        $writer = new Xlsx($this->spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }
}