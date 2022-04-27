<?php


class Database
{

    private static $INSTANCE = null;
    private $mysqli,
    // $HOST = "localhost",
    // $USER = "admin",
    // $PASS = "rahasia",
    // $DATABASE = "lumintu_db",
    // $PORT = "3306";
    
    $HOST = "172.17.0.2",
    $USER = "root",
    $PASS = "salupa",
    $DATABASE = "lumintu_db",
    $PORT = "3306";

    public function __construct()
    {

        $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DATABASE, $this->PORT);

        if (mysqli_connect_error()) {
            die("Koneksi gagal terhubung ke Database");
        }

    }

    // Singleton pattern, Menguji koneksi agar tidak double
    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new Database();
        }

        return self::$INSTANCE;
    }

    public function insert($table, $fields = array())
    {

        // Get Column
        $column = implode(", ", array_keys($fields));

        // Get Values
        $valueArrays = array();
        $i = 0;
        foreach ($fields as $key => $values) {
            
            if ( is_int($values) ) {
                $valueArrays[$i] = $this->escape($values);
            } else {
                $valueArrays[$i] = "'" . $this->escape($values) ."'";
            }

            $i++;
        }

        $values = implode(", ", $valueArrays);

        $query = "INSERT INTO $table ($column) VALUES ($values)";
        
        return $this->run_query($query, "Masalah saat memasukan data");
    }

    public function update($table, $fields, $id)
    {

        // Get Values
        $valueArrays = array();
        $i = 0;

        foreach ($fields as $key => $values) {
            
            if ( is_int($values) ) {
                $valueArrays[$i] = $key . "=" . $this->escape($values);
            } else {
                $valueArrays[$i] = $key . "='" . $this->escape($values) . "'";
            }

            $i++;
        }

        $values = implode(", ", $valueArrays);

        $query = "UPDATE $table SET $values WHERE user_id = $id";  
        // die($query);

        return $this->run_query($query, "Masalah saat mengupdate data");
    }

    public function get_info($table, $column = '', $value = '') {
        if ( !is_int($value) ) {
            $value = "'" . $value . "'";
        }
            
        if ( $column != '' ) {
            $query = "SELECT * FROM $table WHERE $column = $value";
            $result = $this->mysqli->query($query);
    
            while($row = $result->fetch_assoc()) {
                return $row;
            }
        } else {
            $query = "SELECT * FROM $table";
            $result = $this->mysqli->query($query);

            while($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            return $results;
        }

    }

    public function run_query($query, $message) {
        if ($this->mysqli->query($query)) return true;
        else echo($message);
    }

    public function escape($name) {
        return $this->mysqli->real_escape_string(stripslashes(htmlspecialchars($name)));
    }

}