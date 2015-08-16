<?php

class KeuanganMasjid extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_keuanganmasjid');
    }

    function index() {
        $title ['title'] = 'Input Data Keuangan';
        $this->load->view('Header', $title);
        if ($this->session->userdata('USERNAME')) {
            $this->load->view('Login/navbar');
        } else {
            $this->load->view('Public/navbar');
        }
        $data['provinsi'] = $this->m_keuanganmasjid->get_provinsi();
        $data['tahun'] = $this->m_keuanganmasjid->get_tahun();
        $data['bulan'] = $this->m_keuanganmasjid->get_bulan();        
        
        if ($this->input->post('inputProvinsi')) {
            $data['p_prov'] = $this->input->post('inputProvinsi');
        } else {
            $data['p_prov'] = "35"; //Kode Provinsi Jawa Timur
        }
        
        if ($this->input->post('inputBulan')) {
            $data['p_bulan'] = $this->input->post('inputBulan');
        } else {
            $data['p_bulan'] = date("F"); //Current Month
        }
        
        if ($this->input->post('inputMinggu')) {
            $data['p_minggu'] = $this->input->post('inputMinggu');
        } else {
            $data['p_minggu'] = '1'; //First Week
        }
        
        $this->load->view('View_Keuangan_Masjid', $data);
        $this->load->view('Footer');
    }

    public function getKabKota() {
        echo $id_prov = $this->input->post('id_prov', TRUE);
        $data['kk'] = $this->m_keuanganmasjid->get_kabkota($id_prov);
        $output = null;
        foreach ($data['kk'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KABKOTA . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    public function getKec() {
        echo $id_kabkota = $this->input->post('id_kabkota', TRUE);
        $data['k'] = $this->m_keuanganmasjid->get_kecamatan($id_kabkota);
        $output = null;
        foreach ($data['k'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KECAMATAN . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

function grafikKeuanganKota($provinsi, $bulan) {
    $data_detail = $this->m_keuanganmasjid->getDataKeuanganKota($provinsi, $bulan);
    $category = array();
    $category['name'] = 'Kota';
    $series1 = array();
    $series1['name'] = 'Pemasukan';
    $series2 = array();
    $series2['name'] = 'Pengeluaran';
    $series3 = array();
    $series3['name'] = 'Saldo';
    foreach ($data_detail->result() as $row) {
        $category['data'][] = $row->NAMA;
        $series1['data'][] = $row->PEMASUKAN;
        $series2['data'][] = $row->PENGELUARAN;
        $series3['data'][] = $row->SALDO;
    }

    $result = array();
    array_push($result, $category);
    array_push($result, $series1);
    array_push($result, $series2);
    array_push($result, $series3);
    echo json_encode($result, JSON_NUMERIC_CHECK);
}

    function grafikKeuanganBulan($provinsi, $bulan) {  
        $data_detail = $this->m_keuanganmasjid->getDataKeuanganBulan($provinsi, $bulan);
        $category = array();
        $category['name'] = 'Kota';
        $series1 = array();
        $series1['name'] = 'Pemasukan';
        $series2 = array();
        $series2['name'] = 'Pengeluaran';
        $series3 = array();
        $series3['name'] = 'Saldo';
        foreach ($data_detail->result() as $row) {
            $category['data'][] = $row->NAMA;
            $series1['data'][] = $row->PEMASUKAN;
            $series2['data'][] = $row->PENGELUARAN;
            $series3['data'][] = $row->SALDO;
        }

        $result = array();
        array_push($result, $category);
        array_push($result, $series1);
        array_push($result, $series2);
        array_push($result, $series3);
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

    function grafikKeuanganMinggu($minggu, $bulan, $provinsi) {
        $data_detail = $this->m_keuanganmasjid->getDataKeuanganMinggu($minggu, $bulan, $provinsi);
        $category = array();
        $category['name'] = 'Kota';
        $series1 = array();
        $series1['name'] = 'Pemasukan';
        $series2 = array();
        $series2['name'] = 'Pengeluaran';
        $series3 = array();
        $series3['name'] = 'Saldo';
        foreach ($data_detail->result() as $row) {
            $category['data'][] = $row->NAMA;
            $series1['data'][] = $row->PEMASUKAN;
            $series2['data'][] = $row->PENGELUARAN;
            $series3['data'][] = $row->SALDO;
        }

        $result = array();
        array_push($result, $category);
        array_push($result, $series1);
        array_push($result, $series2);
        array_push($result, $series3);
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

    function grafikKeuanganVerified($minggu, $bulan, $provinsi) {
        $data_detail = $this->m_keuanganmasjid->getDataKeuanganVerified($minggu, $bulan, $provinsi);
        $category = array();
        $category['name'] = 'Kota';
        $series1 = array();
        $series1['name'] = 'Pemasukan';
        $series2 = array();
        $series2['name'] = 'Pengeluaran';
        $series3 = array();
        $series3['name'] = 'Saldo';
        foreach ($data_detail->result() as $row) {
            $category['data'][] = $row->NAMA;
            $series1['data'][] = $row->PEMASUKAN;
            $series2['data'][] = $row->PENGELUARAN;
            $series3['data'][] = $row->SALDO;
        }

        $result = array();
        array_push($result, $category);
        array_push($result, $series1);
        array_push($result, $series2);
        array_push($result, $series3);
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

    function formatRp($angka) {
        $rupiah = number_format($angka, 2, ',', '.');
        return $rupiah;
    }

}

?>