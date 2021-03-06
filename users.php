<?php

require_once 'core/init.php';

if (!$user->is_loggedIn()) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}


if (!$user->is_admin(Session::get('email')) && !$user->is_mentor(Session::get('email'))) {
    // Session::flash('profile', 'Halaman ini khusus Admin');
    Redirect::to('403');
}

if ($_GET) {
    $users = $user->get_users_role($_GET['role']);
} else {
    $users = $user->get_users();
}

$user_data = $user->get_data(Session::get('email'));


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <title>Users | Lumintu Classsroom</title>

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

        .dataTables_wrapper {
            font-size: 25px;
            font-weight: 520;
        }

        .dataTables_paginate .paginate_button {
            font-size: 20px;
            min-width: 0.5em !important; 
            padding: 0.0em 0.5em !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            color: black!important;
            border-radius: 4px;
            border: 1px solid #828282;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            background: none;
            color: black!important;
        }  
        

        table.dataTable tbody tr:hover {
            background-color:#eee !important;
        }


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
                        <a href="account-settings.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 hover:text-white">
                            Account Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="flex justify-between">
                <a id="kembali" href="dashboard.php" class="text-[#bd9161] bg-gray-50 hover:bg-[#bd9161] border border-[#bd9161] hover:text-white focus:ring-4 focus:outline-none focus:ring-[#DDB07F] font-medium rounded-lg text-sm px-5 py-1.5 text-center inline-flex items-center mr-2">
                    <svg class="w-6 h-6 mr-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                    </svg>
                    Kembali
                </a>
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="dashboard.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">Users</span>
                        </div>
                    </li>
                </ol>
            </div>

            <?php if (Session::exists('users')) { ?>

                <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                        <?php echo Session::flash('users'); ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

            <?php } ?>

                <!-- Topic Title -->
                <div class="flex items-center gap-x-4 justify-between">
                    <p class="text-xl text-dark-green font-semibold">Informasi User</p>

                    <?php if ($user->is_admin(Session::get('email'))) : ?>
                        <a id="adduser" href="user-form.php" type="button" class="text-[#bd9161] bg-gray-50 hover:bg-[#bd9161] border border-[#bd9161] hover:text-white focus:ring-4 focus:outline-none focus:ring-[#DDB07F] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2">
                            <svg class="w-5 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tambah User
                        </a>
                    <?php endif; ?>
                </div>

            <div class="flex flex-col mt-8 mb-16">
                <?php $filter = $_GET['role'] ?>
                <div class="inline-flex rounded-md shadow-sm mb-1">
                    <a id="all" href="users.php" class="py-2 px-4 text-sm font-medium <?php if (!$filter) : ?> text-blue-700 <?php endif; ?> bg-white rounded-l-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        All
                    </a>
                    <a id="student" href="users.php?role=student" class="py-2 px-4 text-sm font-medium <?php if ($filter == 'student') : ?> text-blue-700 <?php else : ?> text-gray-900 <?php endif; ?> bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        Student
                    </a>
                    <a id="lecturer" href="users.php?role=lecture" class="py-2 px-4 text-sm font-medium <?php if ($filter == 'lecture') : ?> text-blue-700 <?php else : ?> text-gray-900 <?php endif; ?> bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        Lecture
                    </a>
                    <a id="admin" href="users.php?role=admin" class="py-2 px-4 text-sm font-medium <?php if ($filter == 'admin') : ?> text-blue-700 <?php else : ?> text-gray-900 <?php endif; ?> bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        Admin
                    </a>
                </div>

                <div class="container mx-auto">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="p-4 border-b border-gray-200 shadow bg-white">
                                <!-- <table> -->
                                <table id="dataTable" class="p-4">
                                    <thead class="bg-white-50">
                                        <tr>
                                            <th class="p-8 text-xs text-gray-500">
                                                NO
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Username
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Fullname
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Email
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Role
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Status
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Batch
                                            </th>
                                            <th class="p-8 text-xs text-gray-500">
                                                Terdaftar
                                            </th>
                                            <?php if ($user->is_admin(Session::get('email'))) : ?>
                                                <th class="px-6 py-2 text-xs text-gray-500">
                                                    Action
                                                </th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <?php $row = 1; ?>
                                        <?php foreach ($users as $_user) : ?>
                                            <tr class="whitespace-nowrap">
                                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                                    <?= $row ?>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-sm text-gray-900">
                                                        <?php echo $_user['user_username'] ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-sm text-gray-900">
                                                        <?php echo $_user['user_first_name'] ?>
                                                        <?php echo $_user['user_last_name'] ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-sm text-gray-900">
                                                        <?php echo $_user['user_email'] ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-sm text-gray-900">
                                                        <?php echo $_user['role_name'] ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <?php if ($_user['user_status'] == 'verified'): ?>
                                                        
                                                        <span
                                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                            <?php echo $_user['user_status'] ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span
                                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                            <?php echo $_user['user_status'] ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-sm text-gray-500">
                                                        <?php echo $_user['batch_name'] ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                                    <?php echo date("Y-m-d H:i:s", substr($_user['date_created'], 0, 10)) ?>
                                                </td>
                                                <?php if ($user->is_admin(Session::get('email'))) : ?>
                                                    <td>
                                                        <button type="button" id="edit"
                                                            class="py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                            <a href="user-form.php?user_email=<?php echo $_user['user_email'] ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
                                                        </button>
                                                        <button type="button" id="delete" data-modal-toggle="delete-modal<?php echo $_user['user_email'] ?>"
                                                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php $row++ ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($users as $_user) : ?>
        <!-- Modals untuk Delete -->
        <div id="delete-modal<?php echo $_user['user_email'] ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow ">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="delete-modal<?php echo $_user['user_email'] ?>">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah kamu yakin untuk menghapus user ini?</h3>

                        <a href="user-delete.php?user_email=<?php echo $_user['user_email'] ?>" data-modal-toggle="delete-modal<?php echo $_user['user_email'] ?>" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Ya, Saya yakin
                        </a>
                        <button data-modal-toggle="delete-modal<?php echo $_user['user_email'] ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Tidak,
                            Batalkan!</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script>
        let btnToggle = document.getElementById('btnToggle');
        let sidebar = document.querySelector('.sidebar');
        btnToggle.onclick = function() {
            sidebar.classList.toggle('in-active');
        }

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthChange": false,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari data..",   
                    oPaginate: {
                        sNext: '<i class="fa-solid fa-angle-right"></i>',
                        sPrevious: '<i class="fa-solid fa-angle-left"></i>',
                        sFirst: '<i class="fa-solid fa-angle-left"></i>',
                        sLast: '<i class="fa-solid fa-angle-right"></i>'
                    }            
                },
                "bInfo" : false,     
                "responsive": true,           
            });
        });

        


        // intro js
        const intro = introJs();

        intro.setOptions({
            steps: [{
                    title: 'Welcome',
                    intro: 'Hallo Selamat Datang! ????'
                },
                {
                    element: document.querySelector('#bantu1'),
                    intro: 'Ini adalah sidebar'
                },
                {
                    element: document.querySelector('#kembali'),
                    intro: 'Klik ini untuk kembali ke dashboard'
                },
                {
                    element: document.querySelector('#adduser'),
                    intro: 'Klik ini untuk menambah user'
                },
                {
                    element: document.querySelector('#all'),
                    intro: 'Klik ini untuk melihat semua user'
                },
                {
                    element: document.querySelector('#student'),
                    intro: 'Klik ini untuk melihat semua student'
                },
                {
                    element: document.querySelector('#lecturer'),
                    intro: 'Klik ini untuk melihat semua lecturer'
                },
                {
                    element: document.querySelector('#admin'),
                    intro: 'Klik ini untuk melihat semua admin'
                },
                {
                    element: document.querySelector('#edit'),
                    intro: 'Klik ini untuk mengedit data user'
                },
                {
                    element: document.querySelector('#delete'),
                    intro: 'Klik ini untuk menghapus user'
                },
                {
                    title: 'Step Selesai',
                    intro: 'Thank You! ????'
                }
            ]
        });

        var name = 'IntroJS';
        var value = localStorage.getItem(name) || $.cookie(name);
        var func = function() {
            if (Modernizr.localstorage) {
                localStorage.setItem(name, 1)
            } else {
                $.cookie(name, 1, {
                    expires: 365
                });
            }
        };
        if (value == null) {
            intro.start().oncomplete(func).onexit(func);
        };
        // end intro js
    </script>
</body>

</html>