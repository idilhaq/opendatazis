<?php

class m_inputkas extends CI_Model {

    function get_provinsi() {
        $results = array();
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_kabkota($prov) {
        $results = array();
        $this->db->where("ID_PROVINSI", $prov);
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('kabkota');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_kecamatan($kabkota) {
        $results = array();
        $this->db->where("ID_KABKOTA", $kabkota);
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('kecamatan');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_masjid($q) {
//        $this->db->select('NAMA');
        $this->db->like('NAMA', $q);
        $this->db->order_by('NAMA', 'ASC');
        return $this->db->get('masjid')->result_array();
    }
    
    function insert_data($data_kas){
        $this->db->insert('input_keuangan', $data_kas);
    }
    
    function getDataKeuanganKota($parameter){
        $this->db->select('kabkota.NAMA, laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_avg('laporan_keuangan.SALDO');
        $this->db->select_avg('laporan_keuangan.PEMASUKAN');
        $this->db->select_avg('laporan_keuangan.PENGELUARAN');
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid","laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi","provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->where("provinsi.ID_PROVINSI",$parameter);       
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }
    
    function getDataKeuanganBulan($bulan){
        $this->db->select('kabkota.NAMA,laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_sum('laporan_keuangan.SALDO');
        $this->db->select_sum('laporan_keuangan.PEMASUKAN');
        $this->db->select_sum('laporan_keuangan.PENGELUARAN');
        $this->db->where('laporan_keuangan.BULAN',$bulan);
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid","laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }
    
    function getDataKeuanganMinggu($minggu, $bulan){
        $this->db->select('kabkota.NAMA,laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_sum('laporan_keuangan.SALDO');
        $this->db->select_sum('laporan_keuangan.PEMASUKAN');
        $this->db->select_sum('laporan_keuangan.PENGELUARAN');
        $this->db->where('laporan_keuangan.BULAN',$bulan);
        $this->db->where('laporan_keuangan.MINGGU',$minggu);
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid","laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan","masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota","kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }

}
