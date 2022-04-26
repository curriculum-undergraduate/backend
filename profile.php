<?php

require_once 'core/init.php';

if ( !$user->is_loggedIn() ) {
    Session::flash('login', 'Anda harus login terlebih dahulu');
    Redirect::to('login');
}

if ( Session::exists('profile') ) {
    echo Session::flash('profile');
}

$user_data = $user->get_data( Session::get('email') );

?>

<h1>Profile</h1>

<p>Hai <?php echo $user_data['user_username'] ?> </p>
<p>Email kamu: <?php echo $user_data['user_email'] ?> </p>

<?php if ( $user->is_admin( Session::get('email') ) ) { ?> 
    <h3>Hai Admin</h3>
<?php } ?>