<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVousModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fonction pour insérer un nouveau rendez-vous
    public function insert_rendez_vous($data) {
        return $this->db->insert('rendez_vous', $data);
    }

    // Fonction pour obtenir tous les rendez-vous
    public function get_all_rendez_vous() {
        $query = $this->db->get('rendez_vous');
        return $query->result();
    }
}
