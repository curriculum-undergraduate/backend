<?php

require_once 'core/init.php';

$user_data = $user->get_data( Session::get('email') );

$errors = array();

// if ( Input::get('submit') ) {
if ( isset($_POST['submit']) ) {
    if ( Token::check( $_POST['token'] ) ) {

        // Call Validation Object
        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'new_password' => array(
                        'required' => true,
                        'min' => 8,
                        ),
            'confirm_new_password' => array(
                        'required' => true,
                        'match' => 'new_password'
                        ),
        ));    


        // Check Passed
        if ($validation->passed()) {    
            $token = 0;            
            $user->update_user(array(
                'user_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT),
                'user_token' => $token,
            ), 130 ); // disini harus automate dari db

            // email verifikasi dibuat disini

            Session::flash('login', 'Selamat! Password berhasil diupdate');
            Redirect::to('login');

        } else {
            $errors = $validation->errors();
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
                <h3 class="text-2xl font-bold text-gray-600 mb-8">Create New password</h3>
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
                        <label class="block text-black" for="new_password">New Password<label>
                                <input type="password" id="new_password" name="new_password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-black" for="confirm_new_password">Confirm New Password<label>
                                <input type="password" id="confirm_new_password" name="confirm_new_password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black" required>
                    </div>
                    <div class="flex flex-col">
                        <button name="submit"
                            class="px-6 w-auto py-2 mt-6 text-white bg-[#b6833b] rounded-md hover:bg-[#c5985f]">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php require_once "templates/footer.php" ?>