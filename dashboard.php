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
</head>

<body>
<div class="bg-slate-100 w-full h-screen">
<?php require_once 'templates/navbar.php' ?>

<h1 class="text-5xl font-bold text-amber-900 tracking-wider lg:pt-5 pt-16 pl-16">Welcome,</h1>
<h4 class="text-3xl font-semibold text-amber-900 tracking-wider lg:pt-4 pt-2 pl-16"><?php echo $user_data['user_username'] ?></h4>




<?php require_once 'templates/card.php' ?>



<?php require_once 'templates/footer.php' ?>    
</div>
</body>

</html>