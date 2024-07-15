<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reference_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['date_reference'] = $this->Reference_model->get_date_reference();
        $data['contents'] = 'pages/Reference';
        $this->load->view("template/Template", $data);
    }

    public function update() {
        $this->form_validation->set_rules('date_reference', 'Date de Référence', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['date_reference'] = $this->Reference_model->get_date_reference();
            $this->load->view('edit_date_reference', $data);
        } else {
            $data = array(
                'date_reference' => $this->input->post('date_reference')
            );

            if ($this->Reference_model->update_date_reference($data)) {
                $data['date_reference'] = $this->Reference_model->get_date_reference();
                $data['contents'] = 'pages/Reference';
                $this->load->view("template/Template", $data);
            } else {
                $date['error'] = ('error', 'Une erreur s\'est produite lors de la mise à jour de la date de référence');
                $data['date_reference'] = $this->Reference_model->get_date_reference();
                $data['contents'] = 'pages/Reference';
                $this->load->view("template/Template", $data);
            }
        }
    }
}
?>
