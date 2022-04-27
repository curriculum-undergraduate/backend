<?php


class User
{
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function register_user($fields = array())
    {
        if ($this->_db->insert('user', $fields))
            return true;
        else
            return false;
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

    public function is_admin($email) {

        $data = $this->_db->get_info('user', 'user_email', $email);
        
        if ( $data['role_id'] == 1 ) return true;
        else return false;

    }

    public function is_loggedIn() {
        if ( Session::exists('email') ) return true;
        else return false;
    }

    public function get_data($email) {
        
        if ($this->check_name($email)) 
            return $this->_db->get_info('user', 'user_email', $email);
        else
            return "Info user tidak ditemukan";

    }

    public function update_user($fields = array(), $id) {
        if ($this->_db->update('user', $fields, $id) ) return true;
        else return false;

    }

    public function get_users() {
        
        return $this->_db->get_info('user');

    }
    
}