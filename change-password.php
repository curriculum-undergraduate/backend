<?php

require_once 'core/init.php';

if ( !$user->is_loggedIn() ) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}

$user_data = $user->get_data( Session::get('email') );

$errors = array();

// if ( Input::get('submit') ) {
if ( isset($_POST['submit']) ) {
    if ( Token::check( $_POST['token'] ) ) {

        // Call Validation Object
        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'password' => array(
                        'required' => true,
                        ),
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
            if ( password_verify($_POST['password'], $user_data['user_password']) ) {
                $user->update_user(array(
                    'user_password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT)
                ), $user_data['user_id'] );
    
                // email verifikasi dibuat disini
    
                Session::flash('profile', 'Selamat! Password berhasil diupdate');
                Redirect::to('profile');
            } else {
                $errors[] = "Password lama anda salah";
            }

        } else {
            $errors = $validation->errors();
        }
    }
}

require_once "templates/header.php";

?>

</head>

<body>
    <div class="flex items-center justify-center min-h-screen px-10">
        <div class="px-8 py-8 text-left bg-gray-200 rounded-lg md:w-1/2 lg:w-1/2">
            <h3 class="text-2xl font-bold text-center text-black">Change Password</h3>

            <?php if ( !empty($errors) ) { ?>

                <?php foreach ($errors as $error) : ?>
                    <div id="alert-2" class="flex p-4 mb-4 mt-5 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                            <?php echo $error ?>
                        </div>
                        <button type="button"
                            class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                            data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                <?php endforeach; ?>

            <?php } ?>
            <form action="" method="post">
                <div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
                <div class="mt-4">
                    <div class="mt-4">
                        <label class="block text-black" for="old_password">Old Password<label>
                                <input type="password" id="old_password" name="password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-black" required>
                    </div>
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
                    <div class="flex">
                        <a href="profile.php"
                            class="px-6 mr-2 py-2 mt-6 text-white bg-[#f72929] rounded-lg hover:bg-[#c91111]">Back</a>
                        <button name="submit"
                            class="px-6 py-2 mt-6 text-white bg-[#b6833b] rounded-md hover:bg-[#c5985f]">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php require_once "templates/footer.php" ?>