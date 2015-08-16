<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LinkedData extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $title ['title'] = 'Linked Data';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            $this->load->view('Login/navbar');
        } else {
            $this->load->view('Public/navbar');
        }
        $this->load->view('View_Linked_Data');
        $this->load->view('Footer');
    }

}
