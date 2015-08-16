<?php

class m_validasi extends CI_Model {

    function get_data_user($ID_TAKMIR) {
        $results = array();
        $this->db->select("masjid.NAMA AS MASJID, takmir.NAMA AS TAKMIR, masjid.ALAMAT, kecamatan.NAMA AS KEC, kabkota.NAMA AS KABKOTA, provinsi.NAMA AS PROV, masjid.LAT, masjid.LONG, jenis_masjid.NAMA AS JENIS");
        $this->db->from('takmir');
        $this->db->join("masjid", "masjid.ID_MASJID = takmir.ID_MASJID");
        $this->db->join("jenis_masjid", "masjid.ID_JENIS = jenis_masjid.ID_JENIS");
        $this->db->join("kecamatan", "masjid.ID_KECAMATAN = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_data_masjid($sampai, $dari, $ID_TAKMIR) {
        $this->db->select("laporan_keuangan.ID_KEUANGAN, laporan_keuangan.ID_MASJID, laporan_keuangan.PEMASUKAN,laporan_keuangan.PENGELUARAN,laporan_keuangan.SALDO,laporan_keuangan.MINGGU,laporan_keuangan.BULAN,laporan_keuangan.TAHUN");
        $this->db->from("laporan_keuangan");
        $this->db->join("verified_keuangan", "laporan_keuangan.ID_KEUANGAN = verified_keuangan.ID_KEUANGAN", "LEFT");
        $this->db->where("verified_keuangan.ID_KEUANGAN", NULL);
        $this->db->join("takmir", "laporan_keuangan.ID_MASJID = takmir.ID_MASJID");
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        $this->db->order_by("FIELD(laporan_keuangan.BULAN,'January','February','March','April','May','June','July','August','September','October','November','December')");
        $this->db->order_by("laporan_keuangan.MINGGU", "ASC");
        $this->db->limit($sampai, $dari);
        return $query = $this->db->get()->result();
    }

    function get_data_masjid_verified($ID_TAKMIR) {
        $results = array();
        $this->db->select("verified_keuangan.ID_VERIFIED_KEUANGAN, verified_keuangan.ID_KEUANGAN, verified_keuangan.PEMASUKAN,verified_keuangan.PENGELUARAN,verified_keuangan.SALDO, verified_keuangan.MINGGU, verified_keuangan.BULAN, verified_keuangan.TAHUN");
        $this->db->from("verified_keuangan");
        $this->db->join("takmir", "verified_keuangan.ID_MASJID = takmir.ID_MASJID");
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        $this->db->order_by("FIELD(verified_keuangan.BULAN,'January','February','March','April','May','June','July','August','September','October','November','December')");
        $this->db->order_by("verified_keuangan.MINGGU", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function jml_laporan($ID_USER) {
        $this->db->from("takmir");
        $this->db->join("masjid", "masjid.ID_MASJID = takmir.ID_MASJID");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = masjid.ID_MASJID");
        $this->db->where("takmir.ID_TAKMIR", $ID_USER);
        $jml_laporan = $this->db->count_all_results();
        return $jml_laporan;
    }

    function laporan_verified($ID_USER) {
        $this->db->from("takmir");
        $this->db->join("laporan_keuangan", "laporan_keuangan.ID_MASJID = takmir.ID_MASJID");
        $this->db->join("verified_keuangan", "verified_keuangan.ID_KEUANGAN = laporan_keuangan.ID_KEUANGAN");
        $this->db->where("takmir.ID_TAKMIR", $ID_USER);
        $laporan_verified = $this->db->count_all_results();
        return $laporan_verified;
    }

    function jumlah($ID_TAKMIR) {
        $this->db->select("laporan_keuangan.PEMASUKAN,laporan_keuangan.PENGELUARAN,laporan_keuangan.SALDO");
        $this->db->from("laporan_keuangan");
        $this->db->join("verified_keuangan", "laporan_keuangan.ID_KEUANGAN = verified_keuangan.ID_KEUANGAN", "LEFT");
        $this->db->where("verified_keuangan.ID_KEUANGAN", NULL);
        $this->db->join("takmir", "laporan_keuangan.ID_MASJID = takmir.ID_MASJID");
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        return $this->db->get()->num_rows();
    }

    function insert_data($data_kas) {
        $this->db->insert('verified_keuangan', $data_kas);
    }
    
    function update_data($data, $ID) {
        $this->db->update('verified_keuangan', $data, "ID_KEUANGAN = " . $ID);
        return $this->db->affected_rows();
    }

}
