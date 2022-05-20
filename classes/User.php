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

    public function send_mail($fields = array())
    {
        if ($this->_db->insert('user_token', $fields))
            return true;
        else
            return false;
    }

    // public function check_token($token_id) {

    //     $data = $this->_db->get_info('user_token', 'user_token', $token_id);
    //     var_dump($data);
    //     die;
        
    //     if ( empty($data) ) return true;
    //     else return false;

    // }
    public function check_token($token_id) {

        $data = $this->_db->get_info('user_token', 'user_token', $token_id);
        // var_dump($data);
        
        if ( empty($data) ) return false;
        else return true;

    }

    public function get_token($token_id) {

        if ($this->check_token($token_id)) 
            return "Info user tidak ditemukan";            
        else
            return $this->_db->get_info('user', 'user_token', $token_id);

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


    public function check_email($email) {

        $data = $this->_db->get_info('user', 'user_email', $email);
        
        if ( empty($data) ) return false;
        else return true;

    }

    public function check_username($username) {

        $data = $this->_db->get_info('user', 'user_username', $username);

        if ( empty($data) ) return false;
        else return true;

    }

    public function is_admin($email) {

        $data = $this->_db->get_info('user', 'user_email', $email);
        
        if ( $data['role_id'] == 1 ) return true;
        else return false;

    }

    public function is_mentor($email) {

        $data = $this->_db->get_info('user', 'user_email', $email);
        
        if ( $data['role_id'] == 2 ) return true;
        else return false;

    }

    public function is_loggedIn() {
        if ( Session::exists('email') ) return true;
        else return false;
    }

    public function get_data($email) {
        
        if ($this->check_email($email)) 
            return $this->_db->get_info('user', 'user_email', $email);
        else
            return "Info user tidak ditemukan";
    }

    public function get_data_token($token) {
        
        return $this->_db->get_info('user_token', 'user_token', $token);
    }

    public function update_user($fields = array(), $email) {
        if ($this->_db->update('user', $fields, $email) ) return true;
        else return false;

    }

    public function delete_user($table, $email) {
        if ($this->_db->delete($table, $email) ) return true;
        else return false;

    }

    public function get_users() {
        
        return $this->_db->get_info('user');

    }

    public function get_users_role($role) {
        
        return $this->_db->get_info('user', '', '', $role);

    }

    
}