<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory; // Add this line\
use PhpOffice\PhpWord\TemplateProcessor; // Add this line
use PhpOffice\PhpWord\Settings;

class PhpWord_lib
{
    protected $phpWord;

    public function __construct()
    {
        $this->phpWord = new PhpWord();
    }

    public function loadTemplate($template)
    {
        return new TemplateProcessor($template);
    }

    public function setValue($template, $placeholder)
    {
        $document = $this->loadTemplate($template);
        foreach ($placeholder as $key => $val) {
            $document->setValue($key, $val);
        }
        return $document;
    }

    public function saveDocument($document, $filePath)
    {
        $document->saveAs($filePath);
    }

}