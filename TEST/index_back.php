<?php
session_start();
include('dbserver.php');
/*payment*/
if (isset($_POST['payment'])) {
    $num_card_1 = $_POST['type-card-1'];
    $num_card_2 = $_POST['type-card-2'];
    $num_card_3 = $_POST['type-card-3'];
    $num_card_4 = $_POST['type-card-4'];
    if (((int)$num_card_1 == 0) and ((int)$num_card_2 == 0) and ((int)$num_card_3 == 0) and ((int)$num_card_4 == 0)) {
        header("Location: index.php?error=Please select the number of reservations.&status_date=Selected days ago");
        exit();
    } else { 
        if (!((int)$num_card_1 == 0)) {
            $_SESSION['$num_type_1'] = $num_card_1;
        }
        if (!((int)$num_card_2 == 0)) {
            $_SESSION['$num_type_2'] = $num_card_2;
        }
        if (!((int)$num_card_3 == 0)) {
            $_SESSION['$num_type_3'] = $num_card_3;
        }
        if (!((int)$num_card_4 == 0)) {
            $_SESSION['$num_type_4'] = $num_card_4;
        }
        header("Location: up_payment.php?status_payment=detail");
        exit();
    }
    
}

/*date*/
if (isset($_POST['pick_date'])) {
    $date_c = $_POST['date'];
    if (emptypick($date_c) !== false) {
        header("Location: index.php?error=Please pick date before booking the ticket!");
        exit();
    }


    require_once('function.php');

    if (isset($_SESSION['email'])) {
        $date_c = $_POST['date'];
        if (emptypick($date_c) !== false) {
            header("Location: index.php?error=Please pick date before booking the ticket!");
            exit();
        }
        $date = mysqli_real_escape_string($db_con, $_POST['date']);
        $sql_d = "SELECT * FROM ORDERS WHERE booking_date = '$date'";
        $result_d = mysqli_query($db_con, $sql_d);
        $_SESSION['$date'] = $date_c;
        $_SESSION['number_booking'] = strval(mysqli_num_rows($result_d));
        header("Location: index.php?status_date=Selected days ago");
    } else {

        header("Location: logIn_front.php?error=Please login before booking the ticket!");
    }
} else {
    header("Location: index.php");
    exit();
}
/*payment*/


/* back*/
if (isset($_POST['back'])) {
    session_destroy();
    unset($_SESSION['$date']);
    unset($_SESSION['number_booking']);
    header("Location: index.php");
}

$result;
function emptypick($data)
{
    if (empty($data)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
