<?php
session_start();
include('dbserver.php');

/* back*/
if (isset($_POST['upload_payment'])) {
    header("Location: uploadslip_front.php?".$_SESSION['order_id']."");
}
if (isset($_POST['back_payment'])) {
    header("Location: Profile&QR_Code.php");
    exit();
}

?>
