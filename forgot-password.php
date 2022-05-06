<?php

require_once 'core/init.php';
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'send.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = 'api';
$mail->Password = 'bbbef8482d588fcd413720d14e7e0aac';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('no-reply@antheiz.me', 'no-reply');
// $mail->addReplyTo('mail@antheiz.me', 'Theis A'); 

$mail->isHTML(true);

if ( isset($_POST['submit']) ) {
    if ( Token::check( $_POST['token'] ) ) {

        // Call Validation Object

        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'email' => array(
                        'required' => true,
                        'min' => 6,
                        ),
        ));

        // Menguji email apakah sudah atau belum terdaftar di Database
        if ($user->check_name($_POST['email'])) {

            // Check Passed
            if ($validation->passed()) {    

                $email = Session::set('email', $_POST['email']);
                Session::delete('email');
                $user_data = $user->get_data($email);
                unset($user_data['user_email']);
                unset($user_data['role_id']);
                unset($user_data['user_password']);
                unset($user_data['user_username']);
                unset($user_data['user_first_name']);
                unset($user_data['user_last_name']);
                unset($user_data['user_dob']);
                unset($user_data['user_address']);
                unset($user_data['user_gender']);
                unset($user_data['user_phone']);
                unset($user_data['user_profile_picture']);
                unset($user_data['user_token']);


                if ($user_data['user_status'] == 'verified') {

                    $token = rand(999999, 111111);

                    $user->update_user(array(
                        'user_token' => $token,
                    ), $user_data['user_id'] );

                    // email verifikasi dibuat disini
                    $mail->Subject = "Password Reset Code";
                    $mail->addAddress($_POST['email'], "User");
                    // $mail->addEmbeddedImage('feyman.jpg', 'image_cid'); 
                    // $mail->Body = '<img src="cid:image_cid"> Mail body in HTML'; 
                    $mail->Body = "Your token id is <b>$token</b>";

                    if (!$mail->send()) {
                        $errors[] = "Message could not be sent.";
                        // echo 'Message could not be sent.';
                        // echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
                    else {
                        $email = $_POST['email'];
                        Session::flash("reset-code", "We've sent a token code for reset password to your email - $email");
                        Redirect::to('reset-code');
                    }

                } else {
                    $email = $_POST['email'];             
                    Session::flash("verification-code", "It's look like you haven't still verify your email - $email");        
                    Redirect::to('verification-code');
                }
                

            } else {
                $errors = $validation->errors();
            }
    
        } else {

            $errors[] = "Email belum terdaftar";
            
        }    
    }

}

require_once "templates/header.php";

?>

<!-- File Custom CSS -->
<link href="assets/css/custom-auth.css" rel="stylesheet" />
</head>

<body>
    <div class="flex items-center justify-center min-h-screen px-10">
        <div class="px-8 py-8 text-left bg-white rounded-lg md:w-1/2 lg:w-1/2">
            <div class="text-center">
                <a href="index.php"><img class="w-[180px] logo-gradit md:ml-48 mb-6" src="assets/logo/logo_primary.svg" alt="Logo In Career"></a>
                <h3 class="text-2xl font-bold text-gray-600 mb-8">Reset your password</h3>
            </div>
            
            <?php if ( !empty($errors) ) { ?>

                <?php foreach ($errors as $error) : ?>
                    <div id="alert-1" class="flex p-4 mb-4 mt-5 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
                            <?php echo $error; ?>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-blue-200 dark:text-blue-600 dark:hover:bg-blue-300" data-dismiss-target="#alert-1" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                <?php endforeach; ?>

            <?php } ?>

            <?php if ( Session::exists('reset-code') ) { ?>

                <div id="alert-1" class="flex p-4 mb-4 mt-5 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
                        <?php echo Session::flash('reset-code'); ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-blue-200 dark:text-blue-600 dark:hover:bg-blue-300" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

            <?php } ?>

            <form action="" method="post">
                <div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
                <div class="mt-4">
                    <div class="mt-4">
                        <label class="block text-black" for="email">Enter your user account's verified email address and we will send you a token reset password.<label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black" required>
                    </div>
                    <div class="flex flex-col">
                        <button name="submit"
                            class="px-6 w-auto py-2 mt-6 text-white bg-[#b6833b] rounded-md hover:bg-[#c5985f]">Send password reset email</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php require_once "templates/footer.php" ?>