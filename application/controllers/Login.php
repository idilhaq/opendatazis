<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_user'));
    }

    function index() {
        $this->load->view('View_Login');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('Home');
    }

}
