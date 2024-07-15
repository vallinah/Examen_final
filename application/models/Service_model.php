<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert a new service
    public function insert_service($data) {
        return $this->db->insert('service', $data);
    }
    
    // Get all services
    public function get_all_services() {
        $query = $this->db->get('service');
        return $query->result();
    }

    public function update_date_paiement($id, $date_paiement) {
        $this->db->where('id', $id);
        return $this->db->update('service', array('date_paiement' => $date_paiement));
    }

    public function get_service_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('service');
        return $query->row();
    }
}
?>
