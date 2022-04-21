<?php
session_start();


require_once '../config/db.php';
require_once '../inc/header.php';
require_once '../inc/sidebar.php';
require_once '../inc/footer.php';



$query = "SELECT * FROM user";
$results = mysqli_query($conn, $query);

?>
<body>
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
                <p class="text-4xl text-dark-green font-semibold">List All Admin</p>
            </div>

            <!-- Mentor -->
            <div class="md:flex items-center gap-x-4 w-full bg-white py-4 px-10 rounded-xl">
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
                            <th scope="col" class="px-7 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-7 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-7 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-7 py-3">
                                Fullname
                            </th>
                            <th scope="col" class="px-7 py-3">
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
                                        <?php if ($result['role_id'] == 1 ) : ?>
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
                                        <?php endif; ?>
                                        <?php } ?>

                                        <?php endif; ?>
                                </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>