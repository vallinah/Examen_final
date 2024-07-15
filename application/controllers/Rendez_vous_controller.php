<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rendez_vous_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Rendez_vous_model');
    }

    // Afficher le formulaire d'ajout de rendez-vous
    public function create() {
        $data['contents'] = 'pages/create_rendez_vous';
        $this->load->view("template/Template", $data);
    }

    // Insérer un nouveau rendez-vous
    public function store() {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('heure', 'Heure', 'required');
        $this->form_validation->set_rules('id_service', 'Service', 'required|integer');
        $this->form_validation->set_rules('id_slot', 'Slot', 'required|integer');
        $this->form_validation->set_rules('prix', 'Prix', 'required|decimal');
        $this->form_validation->set_rules('id_vehicule', 'Véhicule', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $data['contents'] = 'pages/create_rendez_vous';
            $this->load->view("template/Template", $data);
        } else {
            $data = array(
                'date' => $this->input->post('date'),
                'heure' => $this->input->post('heure'),
                'id_service' => $this->input->post('id_service'),
                'id_slot' => $this->input->post('id_slot'),
                'prix' => $this->input->post('prix'),
                'id_vehicule' => $this->input->post('id_vehicule')
            );

            if ($this->Rendez_vous_model->insert_rendez_vous($data)) {
                $data['contents'] = 'pages/create_rendez_vous';
                $this->load->view("template/Template", $data);
            } else {
                $data['error'] = ('Une erreur s\'est produite lors de l\'ajout du rendez-vous');
                $data['contents'] = 'pages/create_rendez_vous';
                $this->load->view("template/Template", $data);
            }
        }
    }

    // Afficher tous les rendez-vous
    public function index() {
        $data['rendez_vous'] = $this->Rendez_vous_model->get_all_rendez_vous();
        $data['contents'] = 'pages/list_rendez_vous';
        $this->load->view("template/Template", $data);
    }
}
