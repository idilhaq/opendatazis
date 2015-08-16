<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PetaMasjid extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_petamasjid');
        $this->load->library('googlemaps');
    }

    public function index() {
        $title ['title'] = 'Peta Masjid';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            $this->load->view('Login/navbar');
        } else {
            $this->load->view('Public/navbar');
        }
        $data['provinsi'] = $this->m_petamasjid->get_provinsi();
        $data['tahun'] = $this->m_petamasjid->get_tahun();
        $data['bulan'] = $this->m_petamasjid->get_bulan();
        $data['map'] = $this->petaMasjid();
        $this->load->view('View_Peta_Masjid', $data);
        $this->load->view('Footer');
    }

    function getKabKota() {
        echo $id_prov = $this->input->post('id_prov', TRUE);
        $data['kk'] = $this->m_petamasjid->get_kabkota($id_prov);
        $output = null;
        foreach ($data['kk'] as $row) {
//here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KABKOTA . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    function petaMasjid() {
        $config['zoom'] = "auto";
        $config['cluster'] = TRUE;
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

        $coords = $this->m_petamasjid->getLatLong($kabkota, $tahun, $bulan, $minggu);

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
            $marker['icon'] = base_url('assets/icon/mosquee.png');
            $marker['animation'] = 'DROP';         // blank, 'DROP' or 'BOUNCE'
            $this->googlemaps->add_marker($marker);
        }

        return $this->googlemaps->create_map();
    }

    function formatRp($angka) {
        $rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $rupiah;
    }

}
