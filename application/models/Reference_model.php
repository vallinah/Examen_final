<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reference_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function update($data) {
        return $this->db->update('date_reference', $data);
    }

    public function get_date_reference_by_id() {
        $query = $this->db->get('date_reference');
        return $query->row();
    }
}
?>
