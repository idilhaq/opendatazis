<?php

class m_home extends CI_Model {

    function get_provinsi() {
        $results = array();
        $this->db->distinct();
        $this->db->select('provinsi.ID_PROVINSI, provinsi.NAMA');
        $this->db->from('provinsi');
        $this->db->join("kabkota", "kabkota.ID_PROVINSI = provinsi.ID_PROVINSI");
        $this->db->join("kecamatan", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("masjid", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
//        $this->db->where();
        $this->db->group_by('provinsi.NAMA');
        $this->db->order_by('provinsi.NAMA', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_kabkota($prov) {
        $results = array();

        $this->db->distinct();
        $this->db->select('kabkota.ID_KABKOTA, kabkota.NAMA');
        $this->db->from('kabkota');
        $this->db->join("provinsi", "kabkota.ID_PROVINSI = provinsi.ID_PROVINSI");
        $this->db->join("kecamatan", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("masjid", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->where("kabkota.ID_PROVINSI", $prov);
        $this->db->group_by('kabkota.NAMA');
        $this->db->order_by('kabkota.NAMA', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function getLatLong($kabkota, $tahun, $bulan, $minggu) {
        $LatLong = array();
//        $this->db->select("masjid.LAT,masjid.LONG,masjid.NAMA");        
        $this->db->select("masjid.LAT,masjid.LONG,masjid.NAMA,laporan_keuangan.SALDO,laporan_keuangan.PEMASUKAN,laporan_keuangan.PENGELUARAN,laporan_keuangan.BULAN");
        $this->db->from("masjid");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "kecamatan.ID_KECAMATAN = masjid.ID_KECAMATAN");
        $this->db->join("kabkota", "kabkota.ID_KABKOTA = kecamatan.ID_KABKOTA");
        $this->db->where("kabkota.ID_KABKOTA", $kabkota);
        $this->db->where("laporan_keuangan.TAHUN", $tahun);
        $this->db->where("laporan_keuangan.BULAN", $bulan);
        $this->db->where("laporan_keuangan.MINGGU", $minggu);
        $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        $this->db->limit(10);
//        $this->db->select("masjid.LAT,masjid.LONG,masjid.NAMA_MASJID,data.SALDO,data.PEMASUKAN,data.PENGELUARAN");
//        $this->db->from("masjid");
//        $this->db->join("data","data.ID_MASJID = masjid.ID_MASJID");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $LatLong = $query->result();
        }
        return $LatLong;
    }

    function getLatLongInfo($info, $kabkota, $tahun, $bulan, $minggu) {
        $LatLong = array();
        $this->db->select("masjid.LAT,masjid.LONG,masjid.NAMA,laporan_keuangan.SALDO,laporan_keuangan.PEMASUKAN,laporan_keuangan.PENGELUARAN,laporan_keuangan.BULAN");
        $this->db->from("masjid");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "kecamatan.ID_KECAMATAN = masjid.ID_KECAMATAN");
        $this->db->join("kabkota", "kabkota.ID_KABKOTA = kecamatan.ID_KABKOTA");
        $this->db->where("kabkota.ID_KABKOTA", $kabkota);
        $this->db->where("laporan_keuangan.TAHUN", $tahun);
        $this->db->where("laporan_keuangan.BULAN", $bulan);
        $this->db->where("laporan_keuangan.MINGGU", $minggu);
        if ($info == "10pemasukanterbesar") {
            $this->db->order_by('laporan_keuangan.PEMASUKAN', 'DESC');
        } else if ($info == "10pengeluaranterbesar") {
            $this->db->order_by('laporan_keuangan.PENGELUARAN', 'DESC');
        } else if ($info == "10saldoterbesar") {
            $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        } else if ($info == "10pemasukanterkecil") {
            $this->db->order_by('laporan_keuangan.PEMASUKAN', 'ASC');
        } else if ($info == "10pengeluaranterkecil") {
            $this->db->order_by('laporan_keuangan.PENGELUARAN', 'ASC');
        } else if ($info == "10saldoterkecil") {
            $this->db->order_by('laporan_keuangan.SALDO', 'ASC');
        } else if ($info == "10qurbanterbesar") {
            $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        } else if ($info == "10qurbanterkecil") {
            $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        } else if ($info == "10zakatterbesar") {
            $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        } else if ($info == "10zakatterkecil") {
            $this->db->order_by('laporan_keuangan.SALDO', 'DESC');
        }
        $this->db->limit(10);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $LatLong = $query->result();
        }
        return $LatLong;
    }

    function get_bulan() {
        $results = array();
        $this->db->distinct();
        $this->db->select('laporan_keuangan.BULAN');
        $this->db->from('laporan_keuangan');
        $this->db->group_by('laporan_keuangan.BULAN');
        $this->db->order_by('laporan_keuangan.BULAN', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_tahun() {
        $results = array();
        $this->db->distinct();
        $this->db->select('laporan_keuangan.TAHUN');
        $this->db->from('laporan_keuangan');
        $this->db->group_by('laporan_keuangan.TAHUN');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function hitung_laporan_twitter() {
        $laporan = $this->db->count_all_results('tweet_keuangan');
        return $laporan;
    }

    function hitung_laporan_web() {
        $laporan = $this->db->count_all_results('input_keuangan');
        return $laporan;
    }

    function hitung_user_twitter() {
        $this->db->where('FREQ_UPD >', '0');
        $laporan_twit = $this->db->count_all_results('twitter_user');
        return $laporan_twit;
    }

    function hitung_user_web() {
        $this->db->select('user.ID_USER');
        $this->db->distinct();
        $this->db->from('user');        
        $this->db->join('input_keuangan', 'input_keuangan.ID_USER = user.ID_USER');
        $laporan_web = $this->db->count_all_results();
        return $laporan_web;
    }

    function hitung_masjid() {
        $laporan = $this->db->count_all_results('masjid');
        return $laporan;
    }

}
