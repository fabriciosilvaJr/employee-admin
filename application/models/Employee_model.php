<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'DESC')->get('employees')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('employees', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('employees', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('employees', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('employees', ['id' => $id]);
    }
}
