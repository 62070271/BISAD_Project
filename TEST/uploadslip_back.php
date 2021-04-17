<?php
session_start();
include('server.php');
    if (isset($_POST['submit'])){
        $upload = $_FILES['pic']['name'];
        $soderid = $_SESSION['order_id'];

        if($upload != "")
        {
            $path = "images/";

            $type = strrchr($_FILES['pic']['name'], '.');

            date_default_timezone_set('Asia/Bangkok');
            $date = date("Ymd");

            $numrand = (mt_rand());
            $newName =  $date . $numrand . $type;
            $pathCopy = $path . $newName;
            $pathLink = 'images/' . $newName;

            move_uploaded_file($_FILES['pic']['tmp_name'], $pathCopy);

            $tkstatus = "SELECT qrcode_status FROM QR_CODE WHERE qr_id=$accidsql";

            $sql = "INSERT INTO SLIP_OF_PAYMENT (picture, time_stamp, order_id)
                    VALUES ('$newName', '$date', '$soderid')";

            $result = mysqli_query($connection, $sql) or die ("Error in query: $sql " . mysqli_error($connection));

            mysqli_close($connection);
        }
    }
    header('Location: uploadslip_front.php');
?>