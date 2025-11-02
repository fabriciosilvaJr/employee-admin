<?php
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // <- garante o carregamento do DB
    }

    public function authenticate($email, $password)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
