<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginTakmir extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_takmir');
    }
    
    public function index() {
        $this->load->view('View_Login_Takmir');
    }

    function loginTakmir() {
        $this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('View_Login_Takmir');
        } else {
            $usr = $this->input->post('username');
            $psw = $this->input->post('password');
            $u = $usr;
            $p = md5($psw);
            $cek = $this->m_takmir->cek($u, $p);
            if ($cek->num_rows() > 0) {
                //login berhasil, buat session
                $time['LAST_LOGIN'] = NULL;                
                foreach ($cek->result() as $qad) {
                    $sess_data['USERNAME'] = $qad->NAMA;
                    $sess_data['ROLE'] = "takmir";  
                    $sess_data['ID_TAKMIR'] = $qad->ID_TAKMIR;                                        
                    $this->session->set_userdata($sess_data);
                    $this->m_takmir->update_data($time, $data['ID_TAKMIR']);
                }
                redirect('Home');
            } else {
                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
                redirect('LoginTakmir');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('Home');
    }
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
