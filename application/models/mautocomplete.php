<?php
class Mautocomplete extends CI_Model{
    
    public function GetRow($keyword) {
        $this->db->order_by('ID_MASJID', 'DESC');
        $this->db->like("NAMA_MASJID", $keyword);
        return $this->db->get('masjid')->result_array();
    }
}