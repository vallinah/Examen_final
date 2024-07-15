<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $data['contents'] = 'pages/Login';
        $this->load->view("template/Template", $data);
    }

    public function authentification() {
        $mail = $this->input->post('mail');
        $mdp = $this->input->post('mdp');
        $reponse = $this->Admin_model->log($mail, $mdp);
        if ($reponse == 0) {
            $data['error'] = "Identifiants incorrects";
            $data['contents'] = 'pages/Login';
            $this->load->view("template/Template", $data);
        } else {
            $this->session->set_userdata('admin', $reponse);
            $data['contents'] = 'pages/Accueil';
            $this->load->view("template/Template", $data);
        }
        
    }
}
?>
