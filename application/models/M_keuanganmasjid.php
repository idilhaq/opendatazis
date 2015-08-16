<?php

class m_keuanganmasjid extends CI_Model {

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

    function getDataKeuanganKota($provinsi, $bulan) {
        $this->db->select('kabkota.NAMA, laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_avg('laporan_keuangan.SALDO');
        $this->db->select_avg('laporan_keuangan.PEMASUKAN');
        $this->db->select_avg('laporan_keuangan.PENGELUARAN');
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->where('laporan_keuangan.BULAN', $bulan);
        $this->db->where("provinsi.ID_PROVINSI", $provinsi);
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }

    function getDataKeuanganBulan($provinsi, $bulan) {
        $this->db->select('kabkota.NAMA,laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_sum('laporan_keuangan.SALDO');
        $this->db->select_sum('laporan_keuangan.PEMASUKAN');
        $this->db->select_sum('laporan_keuangan.PENGELUARAN');
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->where('laporan_keuangan.BULAN', $bulan);
        $this->db->where("provinsi.ID_PROVINSI", $provinsi);
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }

    function getDataKeuanganMinggu($minggu, $bulan, $provinsi) {
        $this->db->select('kabkota.NAMA,laporan_keuangan.SALDO, laporan_keuangan.PEMASUKAN, laporan_keuangan.PENGELUARAN');
        $this->db->select_sum('laporan_keuangan.SALDO');
        $this->db->select_sum('laporan_keuangan.PEMASUKAN');
        $this->db->select_sum('laporan_keuangan.PENGELUARAN');
        $this->db->where('laporan_keuangan.BULAN', $bulan);
        $this->db->where('laporan_keuangan.MINGGU', $minggu);
        $this->db->where("provinsi.ID_PROVINSI", $provinsi);
        $this->db->from('laporan_keuangan');
        $this->db->join("masjid", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }

    function getDataKeuanganVerified($minggu, $bulan, $provinsi) {
        $this->db->select('kabkota.NAMA,verified_keuangan.SALDO, verified_keuangan.PEMASUKAN, verified_keuangan.PENGELUARAN');
        $this->db->select_sum('verified_keuangan.SALDO');
        $this->db->select_sum('verified_keuangan.PEMASUKAN');
        $this->db->select_sum('verified_keuangan.PENGELUARAN');
        $this->db->where('verified_keuangan.BULAN', $bulan);
        $this->db->where('verified_keuangan.MINGGU', $minggu);
        $this->db->where("provinsi.ID_PROVINSI", $provinsi);
        $this->db->from('verified_keuangan');
        $this->db->join("masjid", "verified_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->join("kecamatan", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->group_by("kabkota.ID_KABKOTA");
        $data = $this->db->get();
        return $data;
    }

}
