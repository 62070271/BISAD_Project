<?php
    $server_name = 'localhost';
    $user_name = 'root';
    $db_name = 'bisad_test01';
    $user_password = '';

    $db_con =  mysqli_connect($server_name, $user_name, $user_password, $db_name) or die("Unable Connect");
        // echo "<script>alert('Connected!');</script>";
?>