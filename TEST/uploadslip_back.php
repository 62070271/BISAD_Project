<?php
session_start();
include('dbserver.php');
    if (isset($_POST['cf'])){
        $_SESSION['order_id']=$_POST['order_id'];
        header("Location:uploadslip_front.php");
    }
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

            $sql = "INSERT INTO SLIP_OF_PAYMENT (picture, time_stamp, order_id)
                    VALUES ('$newName', '$date', '$soderid')";
            $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));

            $up_tk_st = "UPDATE ORDERS SET status='In_progress' WHERE order_id=$soderid";
            $result2 = mysqli_query($db_con, $up_tk_st) or die ("Error in query: $sql " . mysqli_error($db_con));

            mysqli_close($db_con);

            if($result && $result2)
            {
                header("Location: Profile&QR_Code.php?msg=yourSlipHasBeenUpLoad");
            }
        }
    }

    
    // header('Location: uploadslip_front.php');
