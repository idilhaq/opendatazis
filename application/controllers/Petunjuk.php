<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Petunjuk extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $title ['title'] = 'Petunjuk';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            $this->load->view('Login/navbar');
        } else {
            $this->load->view('Public/navbar');
        }
        $this->load->view('View_Petunjuk');
        $this->load->view('Footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
