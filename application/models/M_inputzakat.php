<?php

class m_inputzakat extends CI_Model {

    function get_provinsi() {
        $results = array();
        $this->db->order_by('NAMA_PROVINSI', 'ASC');
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_kabkota($prov) {
        $results = array();
        $this->db->where("ID_PROVINSI", $prov);
        $this->db->order_by('NAMA_KABKOTA', 'ASC');
        $query = $this->db->get('kabkota');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_kecamatan($kabkota) {
        $results = array();
        $this->db->where("ID_KABKOTA", $kabkota);
        $this->db->order_by('NAMA_KECAMATAN', 'ASC');
        $query = $this->db->get('kecamatan');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_masjid($q) {
//        $this->db->select('NAMA_MASJID');
        $this->db->like('NAMA_MASJID', $q);
        $this->db->order_by('NAMA_MASJID', 'ASC');
        return $this->db->get('masjid')->result_array();
    }
    
    function insert_data($data_kas){
        $this->db->insert('temp_data', $data_kas);
    }
    
    function getDataKeuanganKota(){
        $this->db->select('kabkota.NAMA_KABKOTA,data.SALDO, data.PEMASUKAN, data.PENGELUARAN');
        $this->db->select_sum('data.SALDO');
        $this->db->select_sum('data.PEMASUKAN');
        $this->db->select_sum('data.PENGELUARAN');
        $this->db->from('data');
        $this->db->join("masjid","data.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KEC = kecamatan.ID");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID");
        $this->db->group_by("kabkota.ID");
        $data = $this->db->get();
        return $data;
    }
    
    function getDataKeuanganBulan($bulan){
        $this->db->select('kabkota.NAMA_KABKOTA,data.SALDO, data.PEMASUKAN, data.PENGELUARAN');
        $this->db->select_sum('data.SALDO');
        $this->db->select_sum('data.PEMASUKAN');
        $this->db->select_sum('data.PENGELUARAN');
        $this->db->where('data.BULAN',$bulan);
        $this->db->from('data');
        $this->db->join("masjid","data.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KEC = kecamatan.ID");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID");
        $this->db->group_by("kabkota.ID");
        $data = $this->db->get();
        return $data;
    }
    
    function getDataKeuanganMinggu($minggu, $bulan){
        $this->db->select('kabkota.NAMA_KABKOTA,data.SALDO, data.PEMASUKAN, data.PENGELUARAN');
        $this->db->select_sum('data.SALDO');
        $this->db->select_sum('data.PEMASUKAN');
        $this->db->select_sum('data.PENGELUARAN');
        $this->db->where('data.BULAN',$bulan);
        $this->db->where('data.MINGGU',$minggu);
        $this->db->from('data');
        $this->db->join("masjid","data.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KEC = kecamatan.ID");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID");
        $this->db->group_by("kabkota.ID");
        $data = $this->db->get();
        return $data;
    }

}
