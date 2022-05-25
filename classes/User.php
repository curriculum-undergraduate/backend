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

    public function check_token($token_id) {

        $data = $this->_db->get_info('user', 'user_token', $token_id);
        
        if ( empty($data) ) return true;
        else return false;

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

    public function check_name($email) {

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
        
        if ($this->check_name($email)) 
            return $this->_db->get_info('user', 'user_email', $email);
        else
            return "Info user tidak ditemukan";

    }

    public function update_user($fields = array(), $id) {
        if ($this->_db->update('user', $fields, $id) ) return true;
        else return false;

    }

    public function delete_user($id) {
        if ($this->_db->delete('user', $id) ) return true;
        else return false;

    }

    public function get_users() {
        
        return $this->_db->get_info('user');

    }

    public function get_users_role($role) {
        
        return $this->_db->get_info('user', '', '', $role);

    }
    
    // public function Pagination($allData, $totalPages) {

    //     if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
    //         $pageNumber = 1;
    //         $leftLimit = 0;
    //         $rightLimit = $this->productsPerPage; // 0-5
    //     } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
    //         $pageNumber = $totalPages; // 2
    //         $leftLimit = $this->productsPerPage * ($pageNumber - 1); // 5 * (2-1) = 6
    //         $rightLimit = $allData; // 8
    //     } else {
    //         $pageNumber = intval($_GET['page']);
    //         $leftLimit = $this->productsPerPage * ($pageNumber-1); // 5* (2-1) = 6
    //         $rightLimit = $this->productsPerPage; // 5 -> (6,7,8,9,10)
    //     }

    //     $this->pageData['productsOnPage'] = $this->_db->get_info($leftLimit, $rightLimit);

    // }

    
}