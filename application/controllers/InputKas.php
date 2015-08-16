<?php

class InputKas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_inputkas');
        if (!$this->session->userdata('USERNAME')) {
            redirect('Login');
        }
    }

    function index() {
        $title ['title'] = 'Input Data Keuangan';
        $this->load->view('Header', $title);
        $this->load->view('Login/navbar');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
        $this->form_validation->set_rules('inputProvinsi', 'Pilih Provinsi', 'required');
        $this->form_validation->set_rules('inputKotaKab', 'Pilih Kota/Kabupaten', 'required');
        $this->form_validation->set_rules('inputKecamatan', 'Pilih Kecamatan', 'required');
        $this->form_validation->set_rules('inputJenis', 'Pilih Jenis Masjid', 'required');
        $this->form_validation->set_rules('inputNamaMasjid', 'Nama Masjid', 'required');
        $this->form_validation->set_rules('inputAlamatMasjid', 'Alamat Masjid', 'required');
        $this->form_validation->set_rules('inputPemasukan', 'Pemasukan', 'required');
        $this->form_validation->set_rules('inputPengeluaran', 'Pengeluaran', 'required');
        $this->form_validation->set_rules('inputSaldo', 'Saldo', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['provinsi'] = $this->m_inputkas->get_provinsi();
            $data['sukses'] = '';
            $this->load->view('View_Input_Kas', $data);
        } else {
            $data_kas = array(
                'ID_USER' => $this->session->userdata('ID_USER'),
                'MASJID' => $this->input->post('inputNamaMasjid'),
                'JENIS' => $this->input->post('inputJenis'),
                'ALAMAT' => $this->input->post('inputAlamatMasjid'),
                'ID_KECAMATAN' => $this->input->post('inputKecamatan'),
                'SALDO' => str_replace(".","",$this->input->post('inputSaldo')),
                'PEMASUKAN' => str_replace(".","",$this->input->post('inputPemasukan')),
                'PENGELUARAN' => str_replace(".","",$this->input->post('inputPengeluaran')),
                'MINGGU' => $this->GetMinggu(),
                'BULAN' => date('F'),
                'TAHUN' => date('Y')
            );
            $this->m_inputkas->insert_data($data_kas);
            $data['provinsi'] = $this->m_inputkas->get_provinsi();
            $data['sukses'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data berhasil dikirimkan. Terima kasih atas partisipasi Anda :)</div>';
            $this->load->view('View_Input_Kas', $data);
        }
        $this->load->view('Footer');
    }

    function GetMinggu() {
        $day = date('l', time());
        $date = date('d', time());
        $minggu = 0;
        if ($day == 'Friday') {
            $selisih = $date - 7;
            if ($selisih < 0) {
                $minggu = 1;
            } else if ($selisih > 0) {
                $minggu = floor($date / 7) + 1;
            } else {
                $minggu = 1;
            }
        } else {
//    $last_friday = date('Y-m-d', strtotime('last Friday'));
            $last_friday = date('d', strtotime('last Friday'));
            $minggu = floor($last_friday / 7) + 1;
        }
        return $minggu;
    }

    function GetNamaMasjid() {
        $keyword = $this->input->post('keyword');
        $data = $this->m_inputkas->get_masjid($keyword);
        echo json_encode($data);
    }

    public function getKabKota() {
        echo $id_prov = $this->input->post('id_prov', TRUE);
        $data['kk'] = $this->m_inputkas->get_kabkota($id_prov);
        $output = null;
        foreach ($data['kk'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KABKOTA . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    public function getKec() {
        echo $id_kabkota = $this->input->post('id_kabkota', TRUE);
        $data['k'] = $this->m_inputkas->get_kecamatan($id_kabkota);
        $output = null;
        foreach ($data['k'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KECAMATAN . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    function grafikKeuanganKota() {
        if ($this->input->post('inputProvinsi')) {
            $parameter = $this->input->post('inputProvinsi');
        } else {
            $parameter = "35";
        }
        $data_detail = $this->m_inputkas->getDataKeuanganKota($parameter);
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

    function grafikKeuanganBulan() {
        $bulan = date("F");
        $data_detail = $this->m_inputkas->getDataKeuanganBulan($bulan);
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

    function grafikKeuanganMinggu() {
        $minggu = '1';
        $bulan = date("F");
        $data_detail = $this->m_inputkas->getDataKeuanganMinggu($minggu, $bulan);
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

}

?>