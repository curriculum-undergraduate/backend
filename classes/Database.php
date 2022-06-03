<?php

class Database
{

    private static $INSTANCE = null;
    private $mysqli,    
    // $HOST = "localhost",
    // $USER = "ll_lms_account",
    // $PASS = "mD6m55r4kWdp1eKs",
    // $DATABASE = "ll_lms_account",
    // $PORT = "3306";

    $HOST = "172.17.0.2",
    $USER = "root",
    $PASS = "salupa",
    $DATABASE = "lumintu_db",
    $PORT = "3306";

    public function __construct()
    {

        // Melakukan koneksi ke Database
        $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DATABASE, $this->PORT);

        // Jika connection ke Database error, baris berikut akan dieksekusi.
        if (mysqli_connect_error()) {
            Redirect::to("500");
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

    // Fungsi untuk menambah data ke Database
    public function insert($table, $fields = array())
    {

        // Ambil column dari $fields dan tambahkan karakter , (koma)
        $column = implode(", ", array_keys($fields));

        // Ambil value
        $valueArrays = array();
        $i = 0;
        foreach ($fields as $key => $values) {

            // Jika tipe dari $values = int, maka akan di insert tanpa '' (petik dua)
            if (is_int($values)) {
                $valueArrays[$i] = $this->escape($values);
            }

            // Jika tipe dari $values != int, maka akan di insert menggunakan '' (petik dua)
            else {
                $valueArrays[$i] = "'" . $this->escape($values) . "'";
            }

            $i++;
        }

        // Ditambahkan tanda koma untuk setiap values yang akan di input.
        $values = implode(", ", $valueArrays);

        // Query untuk menambahkan data ke Database
        $query = "INSERT INTO $table ($column) VALUES ($values)";

        // Jika tidak ada error, maka data akan berhasil disimpan.
        return $this->run_query($query, "Masalah saat memasukan data");
    }

    // Fungsi untuk mengubah data di Database
    public function update($table, $fields, $column, $value)
    {

        // Get Values
        $valueArrays = array();
        $i = 0;

        foreach ($fields as $key => $values) {

            if (is_int($values)) {
                $valueArrays[$i] = $key . "=" . $this->escape($values);
            }
            else {
                $valueArrays[$i] = $key . "='" . $this->escape($values) . "'";
            }

            $i++;
        }

        $values = implode(", ", $valueArrays);

        if (is_int($value)) {
            $query = "UPDATE $table SET $values WHERE $column = $value";
        }
        else {
            $query = "UPDATE $table SET $values WHERE $column = '$value'";
        }

        return $this->run_query($query, "Masalah saat mengupdate data");
    }

    // Fungsi untuk melakukan delete data
    public function delete($table, $column, $value)
    {
        if (is_int($value)) {
            // Jika $value bertipe int 
            $query = "DELETE FROM $table WHERE $column = $value";
        }
        else {
            // Jika $value bukan bertipe int
            $query = "DELETE FROM $table WHERE $column = '$value'";
        }

        // Jika tidak ada error, maka data akan berhasil disimpan.
        return $this->run_query($query, "Masalah saat mengupdate data");
    }    

    // Fungsi untuk melakukan query ke database
    public function run_query($query, $message)
    {
        if ($this->mysqli->query($query))
            // Jika query yang dilakukan benar
            return true;
        else
            // Jika query yang dilakukan salah
            echo($message);
    }

    // Fungsi untuk memisahkan karakter sql, untuk mengamankan Query SQL Injection
    public function escape($name)
    {
        return $this->mysqli->real_escape_string(stripslashes(htmlspecialchars($name)));
    }



    // Fungsi untuk menampilkan data berdasarkan $table, $column, $value, dan $role
    public function get_info($fields, $table = ' ', $column = ' ', $value = ' ', $role = ' ')
    {
        // Jika $value tidak bertipe int, maka akan ditambahkan '' (petik dua)
        if (!is_int($value)) {
            $value = "'" . $value . "'";
        }

        // Jika $column pada fungsi diisi saat fungsi dipanggil, maka kondisi akan dijalankan.
        if ($column != '') {

            // Get Values
            $valueArrays = array();
            $i = 0;
            foreach ($fields as $key => $values) {
                $valueArrays[$i] = $key;
                $i++;
            }
            $row = implode(", ", $valueArrays);          

            // Memilih semua data column yang memiliki value secara dinamis
            $query = "SELECT $row FROM $table WHERE $column = $value";

            $result = $this->mysqli->query($query);

            // Menampilkan data dalam tipe array_associatipe
            while ($row = $result->fetch_assoc()) {
                return $row;
            }

            
        }

        else if ($table != '') {

            // Memilih semua data column yang memiliki value secara dinamis
            $query = "SELECT * FROM $table";

            $result = $this->mysqli->query($query);

            // Menampilkan data dalam tipe array_associatipe
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            return $results;
        }

        // Jika $role pada fungsi diisi saat fungsi dipanggil, maka kondisi akan dijalankan.
        else if ($role != '') {

            // Get Values
            $valueArrays = array();
            $i = 0;
            foreach ($fields as $key => $values) {
                $valueArrays[$i] = $key;
                $i++;
            }
            $row = implode(", ", $valueArrays); 

            $query = "SELECT $row FROM user LEFT JOIN batch USING(batch_id) JOIN role USING(role_id) WHERE role.role_name = '$role' GROUP BY user.date_created DESC";

            $result = $this->mysqli->query($query);

            // Menampilkan data dalam tipe array_associatipe
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            return $results;

        } 
        // Jika tidak ada parameter pada fungsi saat fungsi dipanggil, maka kondisi akan dijalankan.
        else {          

            // Get Values
            $valueArrays = array();
            $i = 0;
            foreach ($fields as $key => $values) {
                $valueArrays[$i] = $key;
                $i++;
            }
            $row = implode(", ", $valueArrays);   
            
            $query = "SELECT $row FROM user LEFT JOIN batch USING(batch_id) JOIN role USING(role_id) GROUP BY user.date_created DESC";
                
            // query untuk pagination : SELECT * FROM user LEFT JOIN batch USING(batch_id) JOIN role USING(role_id) ORDER BY user.user_id DESC LIMIT 1, 8;
            $result = $this->mysqli->query($query);

            // Menampilkan data dalam tipe array_associatipe
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            return $results;

        }

    }

    public function get_users_batch($role_id)
    {
        // TODO: GANTI LIKE ke =, kalo like berarti batch dengan angka 3 akan muncul juga.
        // TODO: Join dengan Role lagi.
        // SELECT * FROM batch JOIN user ON batch.batch_id = user.batch_id WHERE batch.batch_id = 3; 
        $query = "SELECT user_id, role_id, user.batch_id, user_email, user_username, user_first_name, user_last_name, user_dob, user_address, user_gender, user_phone, user_status, batch_name, batch_start_date, batch_end_date FROM user JOIN batch ON user.batch_id = batch.batch_id WHERE batch.batch_id LIKE $role_id";
        // die($query);
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

    public function get_batch()
    {
        $query = "SELECT * FROM batch";
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

}