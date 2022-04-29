<?php

require_once "../classes/Database.php";

class User {
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function login_user($email, $password)
    {
        $data = $this->_db->get_info('user', 'user_email', $email);

        if (password_verify($password, $data['user_password'])) {
            return true;
        }
        else {
            return false;
        }

    }

    public function check_name($email) {

        $data = $this->_db->get_info('user', 'user_email', $email);
        
        if ( empty($data) ) return false;
        else return true;

    }

    public function get_data($email) {
        
        if ($this->check_name($email)) 
            return $this->_db->get_info('user', 'user_email', $email);
        else
            return "Info user tidak ditemukan";

    }
    
}
