<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validasi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_validasi');
    }

    public function index() {
        $title ['title'] = 'Validasi Data';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            if($this->session->userdata('ROLE') == 'takmir'){
                $this->load->view('takmir/navbar');
                $ID_TAKMIR = $this->session->userdata('ID_TAKMIR');
            }else{
                redirect('LoginTakmir');
            }
        } else {
            redirect('LoginTakmir');
        }
        $data['user'] = $this->m_validasi->get_data_user($ID_TAKMIR);
        $data['verified'] = $this->m_validasi->get_data_masjid_verified($ID_TAKMIR);
//        for ($i = 0; $i < count($data['verified']); $i++) {
//            array_push($data['masjid'], $data['verified'][$i]);
//        }
        $jumlah = $this->m_validasi->jumlah($ID_TAKMIR);

        $config['base_url'] = base_url() . 'index.php/Validasi/index/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 10;
        $config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin'>";
        $config['full_tag_close'] = "</ul>";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['cur_tag_open'] = "<li><a href='#'><b>";
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";

        $data['dari'] = $this->uri->segment('3');
        $data['pending'] = $this->m_validasi->get_data_masjid($config['per_page'], $data['dari'], $ID_TAKMIR);
        $this->pagination->initialize($config);

        $data['laporan'] = $this->m_validasi->laporan_verified($ID_TAKMIR);
        $data['unverified'] = $this->m_validasi->jml_laporan($ID_TAKMIR) - $this->m_validasi->laporan_verified($ID_TAKMIR);
        $this->load->view('View_Validasi', $data);
        $this->load->view('Footer');
    }

    function edit($ID) {
        $data_kas = array(
            'SALDO' => $this->input->post('inputSaldo'),
            'PEMASUKAN' => $this->input->post('inputPemasukan'),
            'PENGELUARAN' => $this->input->post('inputPengeluaran')
        );
        $cek = $this->m_validasi->update_data($data_kas, $ID);
        if ($cek > 0) {
            redirect('Validasi');
        }else{
            redirect('Home');
        }
        
    }

    function verify($ID) {
        $data_kas = array(
            'ID_KEUANGAN' => $ID,
            'ID_MASJID' => $this->input->post('inputIDMasjid'),
            'SALDO' => $this->input->post('inputSaldo'),
            'PEMASUKAN' => $this->input->post('inputPemasukan'),
            'PENGELUARAN' => $this->input->post('inputPengeluaran'),
            'MINGGU' => $this->input->post('inputMinggu'),
            'BULAN' => $this->input->post('inputBulan'),
            'TAHUN' => $this->input->post('inputTahun')
        );
        $this->m_validasi->insert_data($data_kas);
        redirect('Validasi');
    }

}
