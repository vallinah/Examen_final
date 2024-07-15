<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
    }

    // Display the form to add a new service
    public function create() {
        $this->load->view('create_service');
    }

    public function index() {
        $data['services'] = $this->Reference_model->get_all_services();
        $data['contents'] = 'pages/Service';
        $this->load->view("template/Template", $data);
    }

    public function edit_payment_date($id) {
        $data['service'] = $this->Service_model->get_service_by_id($id);
        $data['contents'] = 'pages/Edit_payment_date';
        $this->load->view("template/Template", $data);
    }

    // Handle the form submission
    public function store() {
        // Set validation rules
        $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[255]');
        $this->form_validation->set_rules('duree', 'Durée', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data['error'] = 'Veuillez verifier les donnees que vous enregistrez';
            $data['contents'] = 'pages/Crud_service';
            $this->load->view("template/Template", $data);
        } else {
            $data = array(
                'nom' => $this->input->post('nom'),
                'duree' => $this->input->post('duree')
            );

            if ($this->Service_model->insert_service($data)) {
                $data['contents'] = 'pages/Crud_service';
                $this->load->view("template/Template", $data);
            } else {
                $data['error'] = 'Veuillez verifier les donnees que vous enregistrez';
                $data['contents'] = 'pages/Crud_service';
                $this->load->view("template/Template", $data);
            }

            redirect('service/create');
        }
    }

    // Mettre à jour la date de paiement existante
    public function update_payment_date($id) {
        $this->form_validation->set_rules('date_paiement', 'Date de Paiement', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['service'] = $this->ServiceModel->get_service_by_id($id);
            $data['contents'] = 'pages/Edit_payment_date';
            $this->load->view("template/Template", $data);
        } else {
            $date_paiement = $this->input->post('date_paiement');

            if ($this->ServiceModel->update_date_paiement($id, $date_paiement)) {
                $data['service'] = $this->ServiceModel->get_service_by_id($id);
                $data['contents'] = 'pages/Edit_payment_date';
                $this->load->view("template/Template", $data);
            } else {
                $data['error'] = 'Veuillez verifier les donnees que vous enregistrez';
                $data['service'] = $this->ServiceModel->get_service_by_id($id);
                $data['contents'] = 'pages/Edit_payment_date';
                $this->load->view("template/Template", $data);
            }
        }
    }
}
?>
