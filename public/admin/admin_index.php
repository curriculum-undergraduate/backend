<?php
session_start();

require_once '../config/db.php';


$query = "SELECT * FROM user";
$results = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
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
                   <img src="../Img/icons/toggle_icons.svg" alt="toggle_dashboard" class="w-8 cursor-pointer" id="btnToggle">
                     <img class="w-[150px] logo-gradit" src="../Img/logo/logo_primary.svg" alt="Logo In Career">
                </div>

                <hr class="border-[1px] border-opacity-50 border-[#93BFC1]">

                <!-- List Menus -->
                <div>
                    <ul class="flex flex-col gap-y-1">
                        <li>
                            <a href="" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="../Img/icons/home_icon.svg" alt="Dashboard Icon">
                                <p class="font-semibold">Dashboard</p>
                            </a>
                        </li>
                        <li>
                        <button type="button" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <img class="w-5" src="../Img/icons/consult_icon.svg" alt="Consult Icon">
                          <p class="font-semibold">List User</p>
                          <svg sidebar-toggle-item class=" w-6 h-6 px-1  " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-normal text-light-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Student</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Mentor</a>
                                </li>
                                <li>
                                    <a href="#"
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
                        <a href="#" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="../Img/icons/help_icon.svg" alt="Help Icon">
                            <p class="font-semibold">Help</p>    
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="../Img/icons/logout_icon.svg" alt="Log out Icon">
                            <p class="font-semibold">Log out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Right side -->
        <div class="bg-cgray w-full h-screen px-10 py-6 flex flex-col gap-y-6 overflow-y-scroll">
            <!-- Header / Profile -->
            <div class="flex items-center gap-x-4 justify-end">
                <img class="w-10" src="../Img/icons/default_profile.svg" alt="Profile Image">
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
                <p class="text-4xl text-dark-green font-semibold">List All User With Roles</p>
            </div>

            <!-- Mentor -->
            <div class="flex items-center gap-x-4 w-full bg-white py-4 px-10 rounded-xl">
                <img class="w-14" src="../Img/icons/default_profile.svg" alt="Profile Image">
                <div class="">
                    <p class="text-dark-green text-base font-semibold">Admin Name | Admin Code</p>
                    <p class="text-light-green">Admin Specialization</p>
                </div>
            </div>

            <!-- Tab -->

            <!-- Direction -->


            <!-- Table Assignment -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-8 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-8 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-8 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-8 py-3">
                                Fullname
                            </th>
                            <th scope="col" class="px-8 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-8 py-3">
                                <span class="sr-only">Edit</span>
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($results) : ?>
                        <tbody>
                                    <?php $rows_id = 1; ?>
                                    <?php foreach ($results as $result) { ?>
                                        <tr>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-black"><?= $rows_id ?></td>
                                            <td class="px-8 py-4"><?= $result['user_email'] ?></td>
                                            <td class="px-8 py-4"><?= $result['user_username'] ?></td>
                                            <td class="px-8 py-4"><?= $result['user_full_name'] ?></td>
                                            <td class="px-8 py-4"><?= $result['role_id'] ?></td>
                                            <td class="px-8 py-4"><a href="#">
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                        </tr>
                                        <?php $rows_id++ ?>
                                        <?php } ?>

                                        <?php endif; ?>
                                </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex justify-center items-start p-5 rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-dark">
                        Add Assignment
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                <form>
                   <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-bold text-dark-900 dark:text-dark-300">Title</label>
                        <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                     <div class="mb-6">
                        <label for="startDate" class="block mb-2 text-sm font-bold text-dark-900 dark:text-dark-300">Start Date</label>
                        <input type="datetime-local" id="startDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                     <div class="mb-6">
                        <label for="dueDate" class="block mb-2 text-sm font-bold text-dark-900 dark:text-dark-300">Due Date</label>
                        <input type="datetime-local" id="dueDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                       <label for="deksripsi" class="block mb-2 text-sm font-bold text-dark-900 dark:text-dark-300">Deksripsi</label>
                       <textarea id="deksripsi" rows="4" class="block p-2.5 w-full text-sm text-dark-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                     <div class="mb-6">
                      <label for="input" class="block mb-2 text-sm font-bold text-dark-900 dark:text-dark-300">Due Date</label>
                      <input type="file" id="input"  required>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-6 space-x-2 rounded-b border-gray-200 dark:border-gray-600">
                    <button data-modal-toggle="defaultModal" type="button" class="text-gray bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-transparent dark:hover:bg-dark-700 dark:focus:ring-dark-800">Close</button>
                    <button data-modal-toggle="defaultModal" type="submit" class="text-dark-500 bg-[#DDB07F] hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-[#DDB07F] dark:text--300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Upload</button>
                </div>
                </form>
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