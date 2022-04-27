<?php

require_once 'core/init.php';

if (!$user->is_loggedIn()) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}


if (!$user->is_admin(Session::get('email'))) {
    Session::flash('login', 'Halaman ini khusus Admin');
    Redirect::to('login');
}

$users = $user->get_users();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

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
        .in-active{
            width: 80px !important;
            padding: 20px 15px !important;
            transition: .5s ease-in-out;
        }
        .in-active ul li p{
            display: none !important;
        }

        .in-active ul li a{
            padding: 15px !important;
        }

        .in-active h2,
        .in-active h4,
        .in-active .logo-gradit{
            display: none !important;
        }
        .hidden{
            display: none !important;
        }
        .sidebar{
            transition: .5s ease-in-out;
        }
    </style>

</head>
<body>
    <div class="flex items-center">
        <!-- Left side (Sidebar) -->
        <div class="bg-white w-[350px] h-screen px-8 py-6 flex flex-col justify-between sidebar in-active">
            <!-- Top nav -->
            <div class="flex flex-col gap-y-6">
                <!-- Header -->
                <div class="flex items-center space-x-4 px-2">
                    <img src="assets/icons/toggle_icons.svg" alt="toggle_dashboard" class="w-8 cursor-pointer" id="btnToggle">
                    <img class="w-[150px] logo-gradit" src="assets/logo/logo_primary.svg" alt="Logo In Career">
                </div>

                <hr class="border-[1px] border-opacity-50 border-[#93BFC1]">

                <!-- List Menus -->
                <div>
                    <ul class="flex flex-col gap-y-1">
                        <li>
                            <a href="./admin_index.php"
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="assets/icons/home_icon.svg" alt="Dashboard Icon">
                                <p class="font-semibold">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <img class="w-5" src="assets/icons/consult_icon.svg" alt="Consult Icon">
                                <p class="font-semibold">List User</p>
                                <svg sidebar-toggle-item class=" w-6 h-6 px-1  " fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="./admin_student.php"
                                        class="flex items-center w-full p-2 text-base font-normal text-light-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Student</a>
                                </li>
                                <li>
                                    <a href="./admin_mentor.php"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Mentor</a>
                                </li>
                                <li>
                                    <a href="./admin_admin.php"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Admin</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Bottom nav -->
            <div>
                <ul class="flex flex-col ">
                    <li>
                        <a href="#"
                            class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="assets/icons/help_icon.svg" alt="Help Icon">
                            <p class="font-semibold">Help</p>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php"
                            class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="assets/icons/logout_icon.svg" alt="Log out Icon">
                            <p class="font-semibold">Log out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Right side -->
        <div class="bg-gray-100 w-full h-screen px-10 py-6 flex flex-col gap-y-6 overflow-y-scroll">
            <!-- Header / Profile -->
            <div class="flex items-center gap-x-4 justify-end">
                <img class="w-10" src="assets/icons/default_profile.svg" alt="Profile Image">
                <p class="text-dark-green font-semibold">Admin Name</p>
            </div>

            <!-- Breadcrumb -->
            <div>
                <ul class="flex items-center gap-x-4">
                    <li>
                        <a class="text-light-green" href="#">Dashboard</a>
                    </li>
                </ul>
            </div>

            <!-- Topic Title -->
            <div>
                <p class="text-xl text-dark-green font-semibold">List All User With Roles</p>
            </div>

            <!-- Mentor -->
            <div class="md:flex items-center gap-x-4 w-full bg-white py-4 px-10 rounded-xl">
            <a href="admin_adduser.php"><svg class="w-6 h-6 md:place-items-center" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></a>
                <div class="">
                    <p class="text-dark-green text-base font-semibold">Tambahkan User</p>
                    <p class="text-light-green">dengan Roles yang bisa dipilih</p>
                </div>
            </div>

            <!-- Tab -->

            <!-- Direction -->


            <!-- Table Assignment -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                            <th scope="col" class="px-9 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-9 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-9 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-9 py-3">
                                Firstname
                            </th>
                            <th scope="col" class="px-9 py-3">
                                Lastname
                            </th>
                            <th scope="col" class="px-9 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-9 py-3">
                                <span class="sr-only">Edit</span>
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                                <?php $row = 1 ?>
                                <?php foreach ($users as $_user): ?>
                                    <tr>
                                        <td scope="row" class="px-9 py-4 font-medium text-gray-900 dark:text-grey whitespace-nowrap"><?php echo $row ?></td>
                                        <td class="px-9 py-4"><?php echo $_user['user_email'] ?></td>
                                        <td class="px-9 py-4"><?php echo $_user['user_username'] ?></td>
                                        <td class="px-9 py-4"><?php echo $_user['user_first_name'] ?></td>
                                        <td class="px-9 py-4"><?php echo $_user['user_last_name'] ?></td>
                                        <td class="px-9 py-4"></td>
                                        <td class="px-9 py-4"><a href="#">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                    </tr>
                                    <?php $row++ ?>
                                <?php endforeach; ?>
                        </tbody>
                </table>
            </div>

        </div>
    </div>
    
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script>
        let btnToggle = document.getElementById('btnToggle');
        let sidebar = document.querySelector('.sidebar');
        btnToggle.onclick = function(){
            sidebar.classList.toggle('in-active');
        }
    </script>
</body>
</html>
