<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Word_model extends CI_Model {

    public function replacePlaceholder($masterFilePath, $data) {
        // Load file Word dengan opsi untuk mempertahankan header dan footer
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($masterFilePath, 'Word2007', ['preserveHeaderFooter' => true]);

        // Lakukan penggantian teks seperti biasa
        $sections = $phpWord->getSections();
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $text = $element->getText();
                    foreach ($data as $key => $value) {
                        $placeholder = "[$key]";
                        if (strpos($text, $placeholder) !== false) {
                            $text = str_replace($placeholder, $value, $text);
                            $element->setText($text); // Perbarui teks setelah penggantian
                        }
                    }
                }
            }
        }

        // Simpan perubahan ke file baru dengan opsi untuk mempertahankan header dan footer
        $copiedFilePath = FCPATH . 'assets/masterfile/BAP_2023_modified.docx'; // Sesuaikan dengan lokasi dan nama file yang diinginkan
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($copiedFilePath, ['preserveHeaderFooter' => true]);

        return $copiedFilePath;
    }
    

}