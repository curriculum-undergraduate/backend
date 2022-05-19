<?php


class Batch
{
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function get_batch() {

        return $this->_db->get_batch();

    }

    public function add_batch($fields = array())
    {
        if ($this->_db->insert('batch', $fields))
            return true;
        else
            return false;
    }

    public function update_batch($fields = array(), $id) {
        if ($this->_db->update('batch', $fields, $id) ) return true;
        else return false;
    }

    public function delete_batch($id) {
        if ($this->_db->delete('batch', $id) ) return true;
        else return false;
    }

    
}