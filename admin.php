<?php
// Create database connection using config file
include_once("config/db.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM user ORDER BY user_id DESC");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Undergraduate</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
   
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<body>
<a href="">Add New User</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>Name</th> 
        <th>Mobile</th> 
        <th>Email</th> 
        <th>Update</th>
    </tr>
    <?php  
    while($user_data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$user_data['user_username']."</td>";
        echo "<td>".$user_data['user_phone']."</td>";
        echo "<td>".$user_data['user_email']."</td>";    
        echo "<td><a href='edit.php?id=$user_data[user_id]'>Edit</a> | <a href='delete.php?id=$user_data[user_id]'>Delete</a></td></tr>";        
    }
    ?>
    </table>
</body>


</html>