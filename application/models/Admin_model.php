<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function authentification($mail, $mdp) {
        $reponse = 0;
        $query = $this->db->query("SELECT id FROM administrateur WHERE email = ? AND mots_de_passe = ?", array($mail, $mdp));
        foreach ($query->result_array() as $row) {
            $reponse = $row['id'];
        }
        return $reponse;
    }

}