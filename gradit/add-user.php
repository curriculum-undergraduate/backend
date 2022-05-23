<?php

require_once 'core/init.php';

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
            <!-- Right side -->
        <div class="bg-gray-100 w-full h-screen px-10 py-6 flex flex-col gap-y-6 overflow-y-scroll">
            <!-- Header / Profile -->

            <!-- Breadcrumb -->
                <div class="sm:col-span-2 bg-white rounded-md pb-12 shadow-sm md:mb-40">
                    <div class="mx-8 md:my-8 my-10">             
                        <div class="mb-4 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add User</button>
                                </li>
                            </ul>
                        </div>
                        <div id="myTabContent">
                            <div class="hidden p-4 bg-gray-50 rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div>
                                        <input type="hidden" name="token" value="">
                                    </div>
                                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4">
                                        <div class="mb-6">
                                            <label for="firstName"
                                                class="block mb-2 text-sm font-medium text-gray-900">First
                                                name</label>
                                            <input type="text" id="firstName" name="first_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="First name"
                                                value="" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="lastName"
                                                class="block mb-2 text-sm font-medium text-gray-900">Last
                                                name</label>
                                            <input type="text" id="lastName" name="last_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Last name"
                                                value="" required>
                                        </div>                                        
                                        <div class="mb-6">
                                            <label for="emailAddress"
                                                class="block mb-2 text-sm font-medium text-gray-900">Email
                                                Address</label>
                                            <input type="email" id="emailAddress" name="email_address"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder=" mail@example.com"
                                                value="" required readonly>
                                        </div>
                                        <div class="mb-6">
                                            <label for="dateOfBirth"
                                                class="block mb-2 text-sm font-medium text-gray-900">Date
                                                of
                                                Birth</label>
                                            <input type="date" id="dateOfBirth" name="date_of_birth"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="gender"
                                                class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                                            <select id="countries" name="gender"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                
                                                <option value="Laki-laki">
                                                    
                                                </option>
                                                <option value="Perempuan">Perempuan</option>
                                                
                                                <option value="Perempuan">
                                                    
                                                </option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                
                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <label for="phoneNumber"
                                                class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                                            <input type="tel" id="phoneNumber" name="phone_number"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="(+62) 012 3456 789"
                                                value="" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="gender"
                                                class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                            <select id="countries" name="gender"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="Admin">Admin</option>
                                                <option value="Mentor">Mentor</option>
                                                <option value="Student">Student</option>
                                                <option value="Parents">Parents</option>
                                                
                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <label for="gender"
                                                class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                            <select id="countries" name="gender"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="Verified">Verified</option>
                                                <option value="Unverivied">Unverivied</option>
                                                
                                            </select>
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
                                            placeholder="Jl. Jenderal Sudirman..." required>
                                            </textarea>
                                    </div>
                                    <div class="mb-6 text-right">
                                        <button type="submit" name="submit"
                                            class="sm:w-32 text-white bg-[#DDB07F] hover:bg-[#bd9161] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full md:w-auto px-8 py-2.5 text-center">Add</button>
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