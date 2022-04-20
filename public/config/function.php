<?php
session_start();
require_once 'db.php';

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


function register_user()
{
    global $conn;
    if (isset($_POST['btn_register']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = stripslashes($_POST['username']);
        $email = stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);
        $confirm_password = stripslashes($_POST['confirm_password']);


        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error = "<div>Please Fill in the Blanks</div>";
            set_message($error);
        }
        else {
            if ($password != $confirm_password) {
                $error = "<div> Password Not Matched.</div>";
                set_message($error);
            }
            else {
                $query = "SELECT * FROM user WHERE user_username='$username'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result)) {
                    $error = "<div> User Name Already Exists.</div>";
                    set_message($error);
                }
                else {
                    $query = "SELECT * FROM user WHERE user_email='$email'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result)) {
                        $error = "<div> Email Already Exists.</div>";
                        set_message($error);
                    }
                    else {
                        $hash = md5($password);
                        $sql = "INSERT INTO user (user_id, role_id, user_email, user_password, user_full_name, user_username, user_dob, user_address, user_gender, user_phone, user_profile_picture) VALUES (NULL, '3', '$email', '$hash', '', '$username', NULL, NULL, NULL, NULL, NULL)";
                        $data = mysqli_query($conn, $sql);

                        if ($data) {
                            //    $error = "<div> Record Successfully Registered : ) </div>";
                            //    set_message($error);
                            header('Location: login.php');
                        }
                        else {
                            $error = "<div> Something is Wrong; </div>";
                            echo mysqli_error($conn);
                            set_message($error);
                        }
                    }
                }
            }
        }
    }
}

// function login_user()
// {
//     global $conn;
//     if (isset($_POST['btn_login']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
//         $email = stripslashes($_POST['email']);
//         // $username = stripslashes($_POST['username']);
//         $password = stripslashes($_POST['password']);

//         $email = mysqli_real_escape_string($conn, $_POST['email']);
//         // $email = mysqli_real_escape_string($conn, $_POST['username']);
//         $password = mysqli_real_escape_string($conn, $_POST['password']);

//         if (empty($email) || empty($password)) {
//             $error = "<div> Please Fill in the Blanks</div>";
//             set_message($error);
//         }
//         else {
//             $query = "SELECT * FROM user WHERE user_email='$email'";
//             $result = mysqli_query($conn, $query);

//             if ($row = mysqli_fetch_assoc($result)) {
//                 $db_pass = $row['user_password'];
//                 if (md5($password) == $db_pass) {
//                     $_SESSION['ID'] = $row['user_id'];
//                     $_SESSION['EMAIL'] = $row['user_email'];
//                     $_SESSION['ROLE'] = $row['role_id'];
                    
//                 }
//                 else {
//                     $error = "<div> Please Enter Valid Password</div>";
//                     set_message($error);
//                 }
//             }
//             else {
//                 $error = "<div> Please Enter Valid UserName or Email</div>";
//                 set_message($error);
//             }

//         }
//     }
// }

function login_user()
{

    global $conn, $messages;
    // if (isset($_SESSION['email'])) header('Location: index.php');

    if (isset($_POST['submit'])) {

        // menghilangkan backslash
        $email = stripslashes($_POST['email']);
        $password = sha1(stripslashes($_POST['password']));

        // Cara sederhana secure from sql_injection
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Mengecek apakah form yang diinput user kosong atau tidak
        if (!empty(trim($email)) && !empty(trim($password))) {

            // select data berdasarkan email di database
            $query = "SELECT * FROM user WHERE user_email = '$email' and user_password = '$password'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);

            // Mengecek credentials akun yang diinput user 
            $hash = $data['user_password'];
            if ($password == $hash) {
                $_SESSION['EMAIL'] = $email;
                if ($data['role_id'] ==1) {
                    header('Location: admin_dashboard.php');
                } else {
                    header('Location: ./index.php');
                }
            }
            else {
                $messages = 'Email atau password salah, silahkan periksa kembali.';
            }

        }
        else {
            $messages = "Form wajib diisi ya!";
        }

    }

}

function add_user_admin()
{
    global $conn;
    if (isset($_POST['btn_register']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = stripslashes($_POST['username']);
        $email = stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);
        $confirm_password = stripslashes($_POST['confirm_password']);
        $role_id = stripslashes($_POST['role_id']);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error = "<div>Please Fill in the Blanks</div>";
            set_message($error);
        }
        else {
            if ($password != $confirm_password) {
                $error = "<div> Password Not Matched.</div>";
                set_message($error);
            }
            else {
                $query = "SELECT * FROM user WHERE user_username='$username'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result)) {
                    $error = "<div> User Name Already Exists.</div>";
                    set_message($error);
                }
                else {
                    $query = "SELECT * FROM user WHERE user_email='$email'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result)) {
                        $error = "<div> Email Already Exists.</div>";
                        set_message($error);
                    }
                    else {
                        $hash = md5($password);
                        $sql = "INSERT INTO user (user_id, role_id, user_email, user_password, user_full_name, user_username, user_dob, user_address, user_gender, user_phone, user_profile_picture) VALUES (NULL, $role_id, '$email', '$hash', '', '$username', NULL, NULL, NULL, NULL, NULL)";
                        $data = mysqli_query($conn, $sql);

                        if ($data) {
                            //    $error = "<div> Record Successfully Registered : ) </div>";
                            //    set_message($error);
                            header('Location: admin_student.php');
                        }
                        else {
                            $error = "<div> Something is Wrong; </div>";
                            echo mysqli_error($conn);
                            set_message($error);
                        }
                    }
                }
            }
        }
    }
}


?>