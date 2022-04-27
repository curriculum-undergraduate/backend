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

            <div class="flex flex-col mt-8">
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        #</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Username</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Fullname</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Edit</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Delete</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white">
                                <?php $row = 1; ?>
                                <?php foreach ( $users as $_user ) : ?>                                
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><?php echo $row ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <!-- <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full" src="https://source.unsplash.com/user/erondu"
                                                        alt="admin dashboard ui">
                                                </div> -->

                                                <div class="ml-4">
                                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                                        <?php echo $_user['user_username'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><?php echo $_user['user_first_name'] ?> <?php echo $_user['user_last_name'] ?></div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><?php echo $_user['user_email'] ?></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><?php echo $_user['role_id'] ?></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><?php echo $_user['status_id'] ?></div>
                                        </td>

                                        <!-- <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                                        </td> -->

                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </td>

                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
