<?php

require_once 'core/init.php';

if (!$user->is_loggedIn()) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}


if (!$user->is_admin(Session::get('email')) && !$user->is_mentor(Session::get('email')) ) {
    Session::flash('account-settings', 'Halaman ini khusus Admin');
    Redirect::to('account-settings');
}

$user_data = $user->get_data( Session::get('email') );

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

    <title>Dashboard | Lumintu Classsroom</title>

    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />

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
                <a href="#" class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                    Account Settings
                </a>
            </div>
            </div>
            </div>

            <!-- Breadcrumb -->
            <div>
                <ul class="flex items-center gap-x-4">
                    <li>
                        <a class="text-light-green" href="#">Dashboard</a>
                    </li>
                </ul>
            </div>

            <!-- card user -->
            <div class="sm:flex flex-wrap text-center items-center gap-8">
                <div class="max-w-sm bg-white mt-6 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 ">
                    <a href="users.php">
                        <img class="rounded-t-lg" src="assets/img/background.jpg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="users.php">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">USER</h5>
                        </a>
                    </div>
                </div>

                <!-- card batch -->
                <div class="max-w-sm bg-white mt-6 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <a href="batch.php">
                        <img class="rounded-t-lg" src="assets/img/background.jpg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="batch.php">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">BATCH</h5>
                        </a>
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

        // For Generate Password
        var password=document.getElementById("password");

        function genPassword() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber +1);
            }
            document.getElementById("password").value = password;
        }

        function copyPassword() {
            var copyText = document.getElementById("password");
            copyText.select();
            navigator.clipboard.writeText(copyText.value);
            document.execCommand("copy");  
        }



    </script>
</body>

</html>