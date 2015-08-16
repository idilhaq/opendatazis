<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_home');
        $this->load->library('googlemaps');
    }

    public function index() {
        $title ['title'] = 'Home';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            if($this->session->userdata('ROLE') == 'takmir'){
                $this->load->view('takmir/navbar');
            }else{
                $this->load->view('Login/navbar');
            }
        } else {
            $this->load->view('Public/navbar');
        }
        if($this->input->post('inputInfo')){
            $data['info'] = $this->input->post('inputInfo');            
        }else{
            $data['info'] = "Top 10 Masjid dengan Jumlah Saldo Terbesar";
        }
        $data['provinsi'] = $this->m_home->get_provinsi();
        $data['tahun'] = $this->m_home->get_tahun();
        $data['bulan'] = $this->m_home->get_bulan();
        $data['map'] = $this->petaMasjid();
        $data['jml_laporan'] = $this->m_home->hitung_laporan_twitter() + $this->m_home->hitung_laporan_web();
        $data['jml_user'] = $this->m_home->hitung_user_twitter() + $this->m_home->hitung_user_web();
        $data['jml_masjid'] = $this->m_home->hitung_masjid();
        $this->load->view('View_Home', $data);
        $this->load->view('Footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    function getKabKota() {
        echo $id_prov = $this->input->post('id_prov', TRUE);
        $data['kk'] = $this->m_home->get_kabkota($id_prov);
        $output = null;
        foreach ($data['kk'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KABKOTA . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    function petaMasjid() {
        $config['zoom'] = "auto";
//        $config['cluster'] = TRUE;
        $config['map_height'] = "419px";
        $this->googlemaps->initialize($config);

        if ($this->input->post('inputKotaKab')) {
            $kabkota = $this->input->post('inputKotaKab');
        } else {
            $kabkota = "3578"; //Kota Surabaya
        }

        if ($this->input->post('inputTahun')) {
            $tahun = $this->input->post('inputTahun');
        } else {
            $tahun = date("Y");
        }

        if ($this->input->post('inputBulan')) {
            $bulan = $this->input->post('inputBulan');
        } else {
            $bulan = date("F");
        }

        if ($this->input->post('inputMinggu')) {
            $minggu = $this->input->post('inputMinggu');
        } else {
            $minggu = "1";
        }
        
        if($this->input->post('inputInfo')){
            $info = $this->input->post('inputInfo');
            $coords = $this->m_home->getLatLongInfo($info, $kabkota, $tahun, $bulan, $minggu);
        }else{
            $coords = $this->m_home->getLatLong($kabkota, $tahun, $bulan, $minggu);
        }
        
        $angka = 1;
        foreach ($coords as $coordinate) {
            $marker = array();
            $marker['infowindow_content'] = "<table style=color:black>"
                    . "<tr>"
                    . "    <td align='center' colspan='2'><h3><strong>Masjid " . $coordinate->NAMA . "</strong></h3></td>"
                    . "</tr>"
                    . "<tr>"
                    . "    <td align='center' colspan='2'><strong>Kas " . $bulan . " Minggu ke-" . $minggu . "</strong></td>"
                    . "</tr>"
                    . "<tr>"
                    . "    <td style='width: 100px; color:black'><strong>Pemasukan</strong></td>"
                    . "    <td align='right'><strong>".$this->formatRp($coordinate->PEMASUKAN)."</strong></td>"
                    . "</tr>"
                    . "<tr>"
                    . "    <td><strong>Pengeluaran</strong></td>"
                    . "    <td align='right'><strong>".$this->formatRp($coordinate->PENGELUARAN)."</strong></td>"
                    . "</tr>"
                    . "<tr>"
                    . "    <td><strong>Saldo</strong></td>"
                    . "    <td align='right'><strong>".$this->formatRp($coordinate->SALDO)."</strong></td>"
                    . "</tr>"
                . "</table>";
            $marker['position'] = $coordinate->LAT . ',' . $coordinate->LONG;
            $marker['icon'] = base_url('assets/icon/number_'.$angka.'.png');
            $this->googlemaps->add_marker($marker);
            $angka++;
        }

        return $this->googlemaps->create_map();
//        echo $marker['infowindow_content'];
    }

    function formatRp($angka) {
        $rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $rupiah;
    }

}
