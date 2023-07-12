<?php
// fpdf.php

require('fpdf.php'); // Memasukkan file FPDF yang asli

class FPDF extends FPDF
{
    protected $title;

    public function __construct()
    {
        parent::__construct();
        $this->title = '';
    }

    public function Output($dest = '', $name = '', $isUTF8 = false)
    {
        if ($dest == '') {
            $dest = 'I';
        }
        if ($name == '') {
            $name = 'output.pdf';
        }
        $this->SetTitle($this->title);
        $this->SetAuthor('');
        $this->SetCreator('');
        $this->SetSubject('');
        $this->SetKeywords('');

        if ($dest == 'I') {
            $this->Output($name, $dest);
        } elseif ($dest == 'D') {
            $this->Output($name, $dest);
        } elseif ($dest == 'F') {
            $this->Output($name, $dest);
        } elseif ($dest == 'S') {
            return $this->Output('', $dest);
        } else {
            throw new Exception('Invalid output destination.');
        }
    }
}