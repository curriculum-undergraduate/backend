<?php

require_once 'core/init.php';

if ($user->is_admin(Session::get('email'))) {
    Redirect::to('dashboard');
}

if ( !$user->is_loggedIn() ) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}

$user_data = $user->get_data( Session::get('email') );

$errors = array();

// if ( Input::get('submit') ) {
if ( isset($_POST['submit']) ) {

    // print_r($_POST);
    // print_r($_FILES);
    // die();

    if ( Token::check( $_POST['token'] ) ) {

        // Call Validation Object
        $validation = new Validation();

        // Check Method
        $validation = $validation->check(array(
            'first_name' => array(
                        'required' => true,
                        ),
            'last_name' => array(
                        'required' => true,
                        ),
            'email_address' => array(
                        'required' => true,
                        ),
            'date_of_birth' => array(
                        'required' => true,
                        ),
            'gender' => array(
                        'required' => true,
                        ),
            'phone_number' => array(
                        'required' => true,
                        ),
            'alamat_domisili' => array(
                        'required' => true,
                        ),
        ));    

        // Check Passed
        if ($validation->passed()) {    

            $user->update_user(array(
                'user_first_name' => $_POST['first_name'],
                'user_last_name' => $_POST['last_name'],
                'user_email' => $_POST['email_address'],
                'user_dob' => $_POST['date_of_birth'],
                'user_gender' => $_POST['gender'],
                'user_phone' => $_POST['phone_number'],
                'user_address' => $_POST['alamat_domisili'],
            ), $user_data['user_id'] );

            Redirect::to('account-settings');

        } else {
            $errors = $validation->errors();
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/icons/logo.ico" type="image/x-icon">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <title>Account Settings | Lumintu Classsroom</title>

    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <!-- Icon Getbootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- CDN TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        montserrat: ["Montserrat"],
                    },
                    colors: {
                        "dark-green": "#1E3F41",
                        "light-green": "#659093",
                        "cream": "#DDB07F",
                        "cgray": "#F5F5F5",
                    }
                }
            }
        }
    </script>
    <style>
        .in-active {
            width: 80px !important;
            padding: 20px 15px !important;
            transition: .5s ease-in-out;
        }

        .in-active ul li p {
            display: none !important;
        }

        .in-active ul li a {
            padding: 15px !important;
        }

        .in-active h2,
        .in-active h4,
        .in-active .logo-gradit {
            display: none !important;
        }

        .hidden {
            display: none !important;
        }

        .sidebar {
            transition: .5s ease-in-out;
        }
    </style>

</head>

<body>
    <div class="flex items-center">
        
        <?php require_once 'templates/sidebar.php' ?>

        <!-- Right side -->
        <div class="bg-gray-100 w-full h-screen px-10 py-6 flex flex-col gap-y-6 overflow-y-scroll">
            <!-- Header / Profile -->
            <div class="flex items-center gap-x-4 justify-end">
                <p class="text-dark-green font-semibold text-sm">
                    <?php echo $user_data['user_email'] ?>
                </p>
                <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
                    <button @mouseover="open = true">
                        <img class="w-10" src="assets/icons/default_profile.svg" alt="Profile Image">
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" class="absolute right-0 w-48 bg-white rounded-md">
                        <a href="account-settings.php"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 hover:text-white">
                            Account Settings
                        </a>
                    </div>
                </div>
            </div>

            <?php if ( Session::exists('profile') ) { ?>
            <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                    <?php echo Session::flash('profile'); ?>
                </div>
                <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <?php } ?>

            <!-- Breadcrumb -->
            <div>
                <ul class="flex items-center gap-x-4">
                    <li>
                        <a class="text-light-green text-2xl" href="#">Profile</a>
                    </li>
                </ul>
            </div>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="bg-white w-full md:mr-6 rounded-md sm:h-96 shadow-sm md:mb-40">
                    <div class="text-center py-10">
                        <img src="https://www.shareicon.net/data/512x512/2016/07/26/802043_man_512x512.png" alt=""
                            class="w-40 rounded-full mx-auto">
                        <p class="text-gray-500 mt-11">
                            <?php if ($user_data['role_id'] == 2) : ?>
                                Mentor</p>
                            <?php else : ?>
                                Student</p>
                            <?php endif; ?>                            
                        <h3 class="text-xl">
                            <?php if ($user_data['user_first_name'] != '') : ?>
                                <?php echo strtoupper($user_data['user_first_name']) ?> <?php echo strtoupper($user_data['user_last_name']) ?>
                            <?php else : ?>
                                <?php echo strtoupper($user_data['user_email']) ?>
                            <?php endif; ?>
                        </h3>
                    </div>
                </div>
                <div class="sm:col-span-2 bg-white rounded-md pb-12 shadow-sm md:mb-40">
                    <div class="mx-8 md:my-8 my-10">             
                        <div class="mb-4 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                        </div>
                        <div id="myTabContent">
                            <div class="hidden p-4 bg-gray-50 rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div>
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                    </div>
                                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4">
                                        <div class="mb-6">
                                            <label for="firstName"
                                                class="block mb-2 text-sm font-medium text-gray-900">First
                                                name</label>
                                            <input type="text" id="firstName" name="first_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="First name"
                                                value="<?php echo $user_data['user_first_name'] ?>" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="lastName"
                                                class="block mb-2 text-sm font-medium text-gray-900">Last
                                                name</label>
                                            <input type="text" id="lastName" name="last_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Last name"
                                                value="<?php echo $user_data['user_last_name'] ?>" required>
                                        </div>                                        
                                        <div class="mb-6">
                                            <label for="emailAddress"
                                                class="block mb-2 text-sm font-medium text-gray-900">Email
                                                Address</label>
                                            <input type="email" id="emailAddress" name="email_address"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder=" mail@example.com"
                                                value="<?php echo $user_data['user_email'] ?>" required readonly>
                                        </div>
                                        <div class="mb-6">
                                            <label for="dateOfBirth"
                                                class="block mb-2 text-sm font-medium text-gray-900">Date
                                                of
                                                Birth</label>
                                            <input type="date" id="dateOfBirth" name="date_of_birth"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="<?php echo $user_data['user_dob'] ?>" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="gender"
                                                class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                                            <select id="countries" name="gender"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <?php if ($user_data['user_gender'] == "Laki-laki") : ?>
                                                <option value="Laki-laki">
                                                    <?php echo $user_data['user_gender'] ?>
                                                </option>
                                                <option value="Perempuan">Perempuan</option>
                                                <?php elseif ($user_data['user_gender'] == "Perempuan") : ?>
                                                <option value="Perempuan">
                                                    <?php echo $user_data['user_gender'] ?>
                                                </option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <?php else : ?>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <label for="phoneNumber"
                                                class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                                            <input type="tel" id="phoneNumber" name="phone_number"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="(+62) 012 3456 789"
                                                value="<?php echo $user_data['user_phone'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- TODO: Membuat fitur Upload Profil Picture -->
                                    <!-- <div class="mb-6">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="profile_picture">Profile Picture</label>
                                        <input type="file" id="profile_picture" name="profile_picture" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help">
                                    </div> -->
                                    <div class="mb-6">
                                        <label for="alamatDomisili"
                                            class="block mb-2 text-sm font-medium text-gray-900">Alamat
                                            Domisili</label>
                                        <textarea id="alamatDomisili" name="alamat_domisili" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Jl. Jenderal Sudirman..." required><?php if ($user_data['user_first_name'] != '') : ?> <?php echo $user_data['user_address'] ?> <?php endif; ?>
                                            </textarea>
                                    </div>
                                    <div class="mb-6 text-right">
                                        <button type="submit" name="submit"
                                            class="sm:w-32 text-white bg-[#DDB07F] hover:bg-[#bd9161] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Update</button>
                                    </div>
                                </form>
                            </div>                            
                            <div class="hidden p-4 bg-gray-50 rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="mt-5">
                                    <div class="flex flex-col mb-8">
                                        <h2 class="text-2xl mb-5">Change Password</h2>
                                        <p class="text-sm">If you want to Change password, <a href="change-password.php" target="_blank" class="text-blue-700">click here</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
        <script>
            let btnToggle = document.getElementById('btnToggle');
            let sidebar = document.querySelector('.sidebar');
            btnToggle.onclick = function () {
                sidebar.classList.toggle('in-active');
            }
        </script>
</body>

</html>