<?php
session_start();
include('dbserver.php');

/* back*/
if (isset($_POST['upload_payment'])) {
    // $_SESSION['$date']
    header("Location: uploadslip_front.php?".$_SESSION['order_id']."");
    // header("Location: up_payment.php?ok=bro");
}
if (isset($_POST['back_payment'])) {
    // unset($_SESSION['$num_type_1']);
    // unset($_SESSION['$num_type_2']);
    // unset($_SESSION['$num_type_3']);
    // unset($_SESSION['$num_type_4']);
    // unset($_SESSION['number_booking']);
    // $_SESSION['email'] = $_SESSION['email'];
    header("Location: index.php");
    exit();
}

?>
