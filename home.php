<?php

require_once 'core/init.php';

// if ($user->is_admin(Session::get('email'))) {
//   Redirect::to('dashboard');
// }

var_dump($_SESSION);

if ($user->is_admin(Session::get('email')) && $user->is_mentor(Session::get('email')) ) {
  Redirect::to('home');
}

if (!$user->is_loggedIn()) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
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
  <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css" />

  <title>Dashboard | Lumintu Classsroom</title>

  <!-- Flowbite CSS -->
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

  <!-- DaisyUI -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />

  <!-- CDN TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="bg-slate-100 w-full h-screen">

    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
      <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="https://flowbite.com" class="flex items-center">
          <img src="assets/logo/logo_primary.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
        </a>
        <button data-collapse-toggle="mobile-menu" type="button"
          class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
          <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
            <li>
              <a href="account-settings.php" id="settings"
                class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white"
                aria-current="page">Settings</a>
            </li>
            <li>
              <a href="logout.php" id="logout"
                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Logout</a>
          </ul>
        </div>
      </div>
    </nav>

    <h1 class="text-5xl font-bold text-amber-900 tracking-wider lg:pt-5 pt-16 pl-16">Welcome, </h1>
    <h4 class="text-3xl font-semibold text-amber-900 tracking-wider lg:pt-4 pt-2 pl-16">
       
    <?php if ($user_data['user_first_name'] != '') : ?>
          <?php echo ucfirst($user_data['user_first_name']) ?> <?php echo ucfirst($user_data['user_last_name']) ?>
      <?php else : ?>
          <?php echo ucfirst($user_data['user_email']) ?>
      <?php endif; ?>
    </h1>
    </h4>

    <!-- component -->
    <section class="text-gray-600 body-font bg-slate-100">
      <div class="container px-5 py-24 mx-auto bg-slate-100">
        <div class="flex flex-wrap -m-4">
          <div class="p-4 md:w-1/3" id="bantu1">
            <div class="h-full rounded-xl bg-white overflow-hidden">
              <a href="https://assignment.lumintulogic.com/">
                <img
                  class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100"
                  src="https://images.unsplash.com/photo-1618172193622-ae2d025f4032?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1064&q=80"
                  alt="blog">
              </a>
              <a href="https://assignment.lumintulogic.com/">
                <div class="p-6">
                  <br>
                  <h1 class="title-font text-lg font-medium text-gray-600 mb-3">My Classroom</h1>
                  <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing
                    microdosing tousled waistcoat.</p>
                  <div class="flex items-center flex-wrap ">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="p-4 md:w-1/3" id="bantu2">
            <div class="h-full rounded-xl bg-white overflow-hidden">
              <a href="https://consultation.lumintulogic.com/">
                <img
                  class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100"
                  src="https://images.unsplash.com/photo-1652598113005-a75ff204263b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80"
                  alt="blog">
              </a>
              <a href="https://consultation.lumintulogic.com/">
                <div class="p-6">
                  <br>
                  <h1 class="title-font text-lg font-medium text-gray-600 mb-3">Consultation</h1>
                  <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing
                    microdosing tousled waistcoat.</p>
                  <div class="flex items-center flex-wrap ">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="p-4 md:w-1/3" id="bantu3">
            <div class="h-full rounded-xl bg-white overflow-hidden">
              <a href="https://schedule.lumintulogic.com/">
                <img
                  class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100"
                  src="https://images.unsplash.com/photo-1653299832314-5d3dc1e5a83c?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1854"
                  alt="blog">
              </a>
              <a href="https://schedule.lumintulogic.com/">
                <div class="p-6">
                  <br>
                  <h1 class="title-font text-lg font-medium text-gray-600 mb-3">Schedule</h1>
                  <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing
                    microdosing tousled waistcoat.</p>
                  <div class="flex items-center flex-wrap ">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="p-4 md:w-1/3" id="bantu4">
            <div class="h-full rounded-xl bg-white overflow-hidden">
              <a href="https://schedule.lumintulogic.com/">
                <img
                  class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100"
                  src="https://images.unsplash.com/photo-1646898157740-ffc540df3adb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=290&q=80"
                  alt="blog">
              </a>
              <a href="https://schedule.lumintulogic.com/">
                <div class="p-6">
                  <br>
                  <h1 class="title-font text-lg font-medium text-gray-600 mb-3">Assignment</h1>
                  <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing
                    microdosing tousled waistcoat.</p>
                  <div class="flex items-center flex-wrap ">
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>



    <footer class="p-4 bg-white shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="https://flowbite.com"
          class="hover:underline">GradIT™</a>. All Rights Reserved.
      </span>
      <br>
      <a href="https://flowbite.com" class="flex items-center mb-6 sm:mb-0 mt-2">
        <img src="assets/logo/logo_primary.svg" class="mr-3 h-8" alt="GradIT Logo">
    </footer>

    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />

    <!-- CDN TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
    <script>
                // intro js
        introJs().setOptions({
        steps: [{
            title: 'Welcome',
            intro: 'Hallo Selamat Datang! 👋'
        },
        {
            element: document.querySelector('#settings'),
            intro: 'Klik ini untuk menuju profile kamu'
        },
        {
            element: document.querySelector('#logout'),
            intro: 'Klik ini untuk keluar halaman'
        },
        {
            element: document.querySelector('#bantu1'),
            intro: 'Klik ini untuk menuju classroom kamu'
        },
        {
            element: document.querySelector('#bantu2'),
            intro: 'Klik ini untuk konsultasi'
        },
        {
            element: document.querySelector('#bantu3'),
            intro: 'Klik ini untuk melihat jadwal kamu'
        },
        {
            element: document.querySelector('#bantu4'),
            intro: 'Klik ini untuk melihat tuugas kamu'
        },
        {
            title: 'Step Selesai',
            intro: 'Thank You! 👋'
        }]
        }).start();
    // end intro js  
    </script>
  </div>
</body>

</html>