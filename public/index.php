<?php

    require_once 'config/function.php';
    require_once 'config/db.php';

    if(!isset($_SESSION['ID']) && !isset($_SESSION['EMAIL']))
    {
        header("location: ./login.php");
    }

    $id = $_SESSION['ID'];
    $query = "SELECT * FROM user WHERE user_id='$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>User Registration System in Php</title>
</head>
<body class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card mt-5">
                        <div class="card-header bg-dark text-white">
                            <h3>User Registration System</h3>
                        </div>
                        <div class="card-body">
                            <p>User Name: <span><?php echo $row['user_username'] ?></span></p>
                            <p>User Email: <span><?php echo $row['user_email'] ?></span></p>
                        </div>
                        <div class="card-footer">
                            <a href="login.php" class="btn btn-danger float-end">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>