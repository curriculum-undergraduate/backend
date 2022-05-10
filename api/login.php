<?php

require_once "Model.php";

require "../vendor/autoload.php";

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

// Load dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Atur jenis response
header('Content-Type: application/json');

// Cek method request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit();
}

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$role = $data->role;
$password = $data->password;


// Jika tidak ada data email atau password
if (!isset($email) || !isset($password)) {
  http_response_code(400);
  exit();
}

$user = new User();

if ($user->check_name($email)) {

  if ($user->login_user($email, $password)) {

    // Menghitung waktu kadaluarsa token. Dalam kasus ini akan terjadi setelah 15 menit
    $expired_time = time() + (15 * 60);

    // Buat payload dan access token
    $payload = [
      'email' => $email,
      // Di library ini wajib menambah key exp untuk mengatur masa berlaku token
      'exp' => $expired_time
    ];

    // Men-generate access token
    $access_token = JWT::encode($payload, $_ENV['ACCESS_TOKEN_SECRET'], 'HS256');

    // Kirim kembali ke user
    echo json_encode([
      'success' => true,
      'data' => [
        'accessToken' => $access_token,
        'expiry' => date(DATE_ISO8601, $expired_time)
      ],
      'message' => 'Login berhasil!'
    ]);

    // Ubah waktu kadaluarsa lebih lama, dalam kasus ini 1 jam
    $payload['exp'] = time() + (60 * 60);
    $refresh_token = JWT::encode($payload, $_ENV['REFRESH_TOKEN_SECRET'], 'HS256');

    // Simpan refresh token di http-only cookie
    setcookie('X-LUMINTU-REFRESHTOKEN', $refresh_token, $payload['exp'], '', '', false, true);

  } else {

    // Atur jenis response
    header('Content-Type: application/json');

    echo json_encode([
      'success' => false,
      'data' => null,
      'message' => 'Email atau password tidak sesuai'
    ]);
    exit();

  }

} else {

  // Atur jenis response
  header('Content-Type: application/json');
  
  echo json_encode([
    'success' => false,
    'data' => null,
    'message' => 'Email belum terdaftar'
  ]);
  exit();
}

?>