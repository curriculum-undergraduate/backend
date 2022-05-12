<?php

require_once "core/init.php";

if ( $user->is_loggedIn() ) {
    Redirect::to('account-settings');
}

$errors = array();

// if ( Input::get('submit') ) {
if ( isset($_POST['submit']) ) {

    if ( Token::check( $_POST['token'] ) ) {
        // Call Validation Object

        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'email' => array('required' => true),
            'password' => array('required' => true)
        ));

        // Check Passed
        if ($validation->passed()) {    

            // Menguji email apakah sudah atau belum terdaftar di Database
            if ($user->check_name($_POST['email'])) {

                if ( $user->login_user($_POST['email'], $_POST['password'] ) ) {
                    $email = Session::set('email', $_POST['email']);
                    Session::delete('email');
                    $user_data = $user->get_data($email);
                    unset($user_data['user_email']);
                    unset($user_data['user_id']);
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
                        // Session::flash('profile', 'Selamat! anda berhasil login');
                        Session::set('email', $_POST['email']);
                        if (!$user->is_admin(Session::get('email')) || !$user->is_mentor(Session::get('email'))) {
                            // This is not secure
                            $user_data = $user->get_data($email);
                            unset($user_data['user_password']);
                            $_SESSION['user_data'] = $user_data;
                            // End
                            Redirect::to('account-settings');
                        } else {
                            Redirect::to('dashboard');
                        }
                    } else {
                        $email = $_POST['email'];             
                        Session::flash("verification-code", "It's look like you haven't still verify your email - $email");        
                        Redirect::to('verification-code');
                    }
                    
    
                } else {
    
                    $errors[] = "Login gagal";
    
                }
                
            } else {

                $errors[] = "Email belum terdaftar";

            }

        } else {
            $errors = $validation->errors();
        }
    } // end of input token

} // endof submit form

$title_page = "Login";

require_once "templates/header.php";

?>

<!-- File Custom CSS -->
<link href="assets/css/custom-auth.css" rel="stylesheet" />
  </head>

<body style="background-image: url('assets/img/background.jpg')">
    <div class="container px-8 max-w-md mx-auto sm:max-w-xl md:max-w-5xl lg:flex lg:max-w-full lg:p-0">
        <div class="lg:p-16 lg:mt-8 lg:flex-1">
            <h2 class="text-4xl font-bold text-white tracking-wider lg:pt-5 pt-24">
                GradIT Course
            </h2>
            <h3 class="text-2xl font-semibold text-white tracking-wider mt-3">
                Welcome Back!
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

            <?php if ( Session::exists('login') ) { ?>

                <div id="alert-1" class="flex p-4 mb-4 mt-5 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
                        <?php echo Session::flash('login'); ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-blue-200 dark:text-blue-600 dark:hover:bg-blue-300" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

            <?php } ?>

            <form method="post">
                <div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
                <div class="mt-5">
                    <div class="mt-4">
                        <label class="block text-white" for="email">Email<label>
                                    <input type="email" placeholder="name@gmail.com" name="email"
                                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black"
                                        required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-white">Password<label>
                                <input type="password" placeholder="Password" name="password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black"
                                    required>
                    </div>

                    <div class="flex">
                        <button class="w-full px-6 py-2 mt-4 text-white bg-[#b6833b] rounded-full hover:bg-[#c5985f]"
                            name="submit">Sign In</button>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-white"> Remember me </label>
                        </div>

                        <div class="text-sm">
                            <a href="forgot-password.php" class="font-medium text-white hover:underline"> Forgot
                                password? </a>
                        </div>
                    </div>


                    <div class="mt-6 text-white place-items-end">
                        Don't have an account?
                        <a class="text-white font-bold hover:underline" href="register.php">
                            Sign Up
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="hidden lg:flex lg:w-1/2 my-auto p-36">
            <img src="assets/img/login.png"
                class="animate-bounce lg:mt-10 lg:h-full lg:w-80 lg:object-scale-down lg:object-top">
        </div>
    </div>

<?php require_once "templates/footer.php" ?>