<?php

require_once "Model.php";

// Import script autoload agar bisa menggunakan library
require "../vendor/autoload.php";

// Import library
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

// Load dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Atur jenis response
header('Content-Type: application/json');

// Cek method request
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit();
}

$headers = getallheaders();

// Periksa apakah header authorization-nya ada
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    exit();
}

$user = new User();

// Mengambil token
list(, $token) = explode(' ', $headers['Authorization']);

try {
    // Men-decode token. Dalam library ini juga sudah sekaligus memverfikasinya
    $payload = JWT::decode($token, new Key($_ENV['ACCESS_TOKEN_SECRET'], 'HS256'));
    $user_data = $user->get_data($payload->{ 'email'});
    // if ($user_data['role_id'] != 3) {

    //     $users = $user->get_users($user_data['batch_id']);
    //     echo json_encode([
    //         'success' => true,
    //         "user" => $users,
            
    //     ]);
    // } else {
    //     echo json_encode([
    //         'success' => false,
    //         'data' => null,
    //         'message' => 'Akses ditolak'
    //     ]);
    //     http_response_code(401);
    //     exit();
    // }
    $users = $user->get_users($user_data['batch_id']);
    echo json_encode([
        'success' => true,
        "user" => $users,
        
    ]);

}
catch (Exception $e) {
    // Bagian ini akan jalan jika terdapat error saat JWT diverifikasi atau di-decode
    echo json_encode([
        'success' => false,
        'data' => null,
        'message' => 'Data gagal diload'
    ]);
    http_response_code(401);
    exit();
}
