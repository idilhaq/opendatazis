<?php

class M_takmir extends CI_Model {

    function insert_data($data) {
        $this->db->insert('takmir', $data);
    }

    function update_data($data, $ID_TAKMIR) {
        $this->db->update('takmir', $data, "ID_TAKMIR = " . $ID_TAKMIR);
    }

    function cek_user($ID_TAKMIR) {
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        return $this->db->get('takmir');
    }

    function cek($ID_TAKMIR, $password) {
        $this->db->where("ID_TAKMIR", $ID_TAKMIR);
        $this->db->where("PASSWORD", $password);
        return $this->db->get("takmir");
    }

}
