<?php
    $server_name = 'freedb.tech';
    $user_name = 'freedbtech_Weeravat';
    $user_password = 'KLIptp17';
    $db_name = 'freedbtech_BISADProject';
    
    $db_con =  mysqli_connect($server_name, $user_name, $user_password, $db_name) or die ("Unable Connect");
    mysqli_set_charset($db_con, "utf8");
?>