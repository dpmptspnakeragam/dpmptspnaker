<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ============================================================
// 1. "BAPAK" UNTUK WEB UTAMA
// ============================================================
class Admin_Utama_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // 1. CEK SESSION WEB UTAMA
        if (empty($this->session->userdata('username')) || !$this->session->userdata('logged_in_utama')) {
            redirect('login');
        }

        // 2. CEGAH CACHE BROWSER
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}

// ============================================================
// 2. "BAPAK" UNTUK WEB REKLAME (Sekalian kita buatkan)
// ============================================================
class Admin_Reklame_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // 1. CEK SESSION REKLAME
        if (!$this->session->userdata('logged_in_reklame')) {
            redirect('login_reklame');
        }

        // 2. CEGAH CACHE BROWSER
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}
