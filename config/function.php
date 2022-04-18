<?php
// menghubungkan dengan file db.php 
require_once 'db.php';

// inisiasi session
session_start();

$messages = '';
$validate = '';

// Set Session Message
function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['MESSAGE'] = $msg;
    }
    else {
        $msg = '';
    }
}

// display Session Message
function display_message()
{
    if (isset($_SESSION['MESSAGE'])) {
        echo $_SESSION['MESSAGE'];
        unset($_SESSION['MESSAGE']);
    }
}


function userRegister()
{
    global $conn, $messages;

    if (isset($_POST['register'])) {

        // Mengamankan dari XSS
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Menghilangkan backslash
        $username = stripslashes($username);
        $email = stripslashes($email);
        $password = stripslashes($password);

        // Mengamankan dari SQL Injection
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Mengecek apakah form yang diinput kosong atau tidak
        if (!empty(trim($username)) && !empty(trim($email)) && !empty(trim($password))) {

            // select data berdasarkan input dari user
            $query = "SELECT * FROM user WHERE user_username='$username' OR user_email='$email'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);

            // Memeriksa apakah email dan username sudah terdaftar atau belum
            $length = 0;
            if ($rows != $length) {
                $messages = "Akun dengan username/email sudah ada";
            }
            else {

                // Mengecek lenth password harus lebih dari 8 karakter
                $length = 8;
                if (strlen($password) < $length) {
                    $messages = "Password harus minimal 8 karakter";
                }
                else {
                    // Menambahkan user/akun baru
                    $hash = sha1($password);
                    $role_id = 3;
                    $status_id = 0;
                    $query = "INSERT INTO user (user_id, role_id, status_id, user_email, user_password, user_full_name, user_username, user_dob, user_address, user_gender, user_phone, user_profile_picture) VALUES (NULL, $role_id, $status_id, '$email', '$hash', '', '$username', NULL, NULL, NULL, NULL, NULL)";
                    $result = mysqli_query($conn, $query);

                    // Jika akun berhasil didaftarkan, maka system akan mengalihkan ke Login Page
                    if ($result) {
                        $messages = "Akun berhasil terdaftar!";
                        header('Location: login.php');
                    }
                    else {
                        $messages = mysqli_error($conn);
                    }
                }

            }

        }
        else {
            $error = "Form wajib diisi ya!";
        }


    }

}

function login_user()
{
    global $conn;
    if (isset($_POST['btn_login']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = stripslashes($_POST['email']);
        // $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // $email = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($email) || empty($password)) {
            $error = "<div> Please Fill in the Blanks</div>";
            set_message($error);
        }
        else {
            $query = "SELECT * FROM user WHERE user_email='$email'";
            $result = mysqli_query($conn, $query);

            if ($row = mysqli_fetch_assoc($result)) {
                $db_pass = $row['user_password'];
                if (md5($password) == $db_pass) {
                    header("location: ./index.php");
                    $_SESSION['ID'] = $row['user_id'];
                    $_SESSION['EMAIL'] = $row['user_email'];
                }
                else {
                    $error = "<div> Please Enter Valid Password</div>";
                    set_message($error);
                }
            }
            else {
                $error = "<div> Please Enter Valid UserName or Email</div>";
                set_message($error);
            }

        }
    }
}


?>