<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Employee_model');
    $this->load->library('session');
    $this->load->helper(['url', 'form']);
    if (!$this->session->userdata('user')) redirect('auth');
  }

  public function index() {
    $data['employees'] = $this->Employee_model->get_all();
    $this->load->view('employees/index', $data);
  }

  public function create() {
    if ($this->input->method(TRUE) === 'POST') {
      $data = $this->input->post();
      if ($this->Employee_model->insert($data))
        echo json_encode(['status' => 'success', 'message' => 'Funcionário adicionado com sucesso!']);
      else
        echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar funcionário.']);
    }
  }

 public function update($id)
{
    if ($this->input->method(TRUE) === 'POST') {
        $data = $this->input->post();
        unset($data['id']);
        if ($this->Employee_model->update($id, $data)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Funcionário atualizado com sucesso!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao atualizar funcionário.'
            ]);
        }
    } else {
        show_404();
    }
}


  public function delete($id) {
    if ($this->Employee_model->delete($id))
      echo json_encode(['status' => 'success', 'message' => 'Funcionário excluído com sucesso!']);
    else
      echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir funcionário.']);
  }
}
