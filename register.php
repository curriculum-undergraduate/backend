<?php

require_once "core/init.php";
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


if ( $user->is_loggedIn() ) {
    Redirect::to('profile');
}

$errors = array();

// if ( Input::get('submit') ) {
if ( isset($_POST['submit']) ) {
    if ( Token::check( $_POST['token'] ) ) {

        // Call Validation Object

        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'username' => array(
                        'required' => true,
                        'max' => 50,
                        ),
            'email' => array(
                        'required' => true,
                        'min' => 6,
                        ),
            'password' => array(
                        'required' => true,
                        'min' => 8,
                        ),
            'password_verify' => array(
                        'required' => true,
                        'match' => 'password',
                        ),
        ));

        // Menguji email apakah sudah atau belum terdaftar di Database
        if ($user->check_name($_POST['email'])) {

            $errors[] = "Email sudah terdaftar";
    
        } else {

            // Check Passed
            if ($validation->passed()) {    

                $token = rand(999999, 111111);

                $user->register_user(array(
                    'user_username' => $_POST['username'],
                    'user_email' => $_POST['email'],
                    'user_password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                    'user_token' => $token,
                ));

                // email verifikasi dibuat disini
                $mail->Subject = "Email Verification";
                $mail->addAddress($_POST['email'], $_POST['username']);
                $email_template = 'templates/mail.html';
                $mail->Body = file_get_contents($email_template);
                $mail->addEmbeddedImage('assets/logo/logo_primary.png', 'image_cid'); 
                $mail->Body = str_replace("{token}", $token,  $mail->Body);

                if (!$mail->send()) {
                    $errors[] = "Message could not be sent.";
                    // echo 'Message could not be sent.';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
                else {
                    $email = $_POST['email'];
                    Session::flash("verification-code", "We've sent a verification code to your email - $email");
                    Redirect::to('verification-code');
                }

            } else {
                $errors = $validation->errors();
            }
        }    
    }

}

require_once "templates/header.php";

?>

<!-- File Custom CSS -->
<link href="assets/css/custom-auth.css" rel="stylesheet" />
  </head>

<body>
    <div class="container px-8 max-w-md mx-auto sm:max-w-xl md:max-w-5xl lg:flex lg:max-w-full lg:p-0">
        <div class="lg:p-16 lg:flex-1">
        <h2 class="text-4xl font-bold  tracking-wider sm:text-4xl">
            GradIT Course
        </h2>
        <h3 class="text-2xl font-semibold tracking-wider mt-3">
            Register Here
        </h3> 

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

        <form method="post" id="register-form">
            <div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            </div>
            <div class="mt-5">
                <div>
                    <label class="block" for="username">Username<label>
                    <input type="text" placeholder="Username" name="username" id="username"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black required:" required>
                </div>
                <div class="mt-4">
                    <label class="block" for="email">Email<label>
                    <input type="email" placeholder="name@gmail.com" name="email" id="email"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black required:" required>
                </div>
                <div class="mt-4">
                    <label class="block" for="password">Password<label>
                    <input type="password" placeholder="Password" name="password" id="password"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black required:" required>
                </div>
                <div class="mt-4">
                    <label class="block" for="password_verify">Repeat Password<label>
                    <input type="password" placeholder="Verify Password" name="password_verify" id="password_verify"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black required:" required>
                </div>
                <br>
                <!-- <span class="text-white">Dengan mendaftar, kamu setuju dengan syarat dan ketentuan kami </span> -->
                <div class="flex mt-3">
                    <button class="w-full px-6 py-2 mt-4 text-white bg-[#b6833b] rounded-full hover:bg-[#c5985f]" name="submit"  onclick="CheckLength('InputPassword')">Create
                        Account</button>
                </div>
                <div class="mt-6 text-white">
                    Already have an account?
                    <a class="text-white font-bold hover:underline" href="login.php">
                        Sign In
                    </a>
                </div>
            </div>
        </form>
        </div>
        <div class="hidden lg:flex lg:w-1/2 my-auto p-36">
        <img src="assets/img/register.png" class="animate-bounce-slow lg:mt-10 lg:h-full lg:w-full">
        </div>
    </div>



<?php require_once "templates/footer.php" ?>