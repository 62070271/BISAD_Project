<?php
session_start();
include('dbserver.php');
require_once('function.php');


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
        $_SESSION['sum_price'] = 0;
        $_SESSION['total_quantity'] = 0;
        if (!((int)$num_card_1 == 0)) {
            $_SESSION['$num_type_1'] = $num_card_1;
            $_SESSION['sum_type_1'] = (int)$_SESSION['card_price_1'] * (int)$_SESSION['$num_type_1'];
            $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_1'];
            $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_1'];
        }else {
            unset($_SESSION['$num_type_1']);
        }
        if (!((int)$num_card_2 == 0)) {
            $_SESSION['$num_type_2'] = $num_card_2;
            $_SESSION['sum_type_2'] = (int)$_SESSION['card_price_2'] * (int)$_SESSION['$num_type_2'];
            $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_2'];
            $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_2'];
        }else {
            unset($_SESSION['$num_type_2']);
        }
        if (!((int)$num_card_3 == 0)) {
            $_SESSION['$num_type_3'] = $num_card_3;
            $_SESSION['sum_type_3'] = (int)$_SESSION['card_price_3'] * (int)$_SESSION['$num_type_3'];
            $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_3'];
            $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_3'];
        }else {
            unset($_SESSION['$num_type_3']);
        }
        if (!((int)$num_card_4 == 0)) {
            $_SESSION['$num_type_4'] = $num_card_4;
            $_SESSION['sum_type_4'] = (int)$_SESSION['card_price_4'] * (int)$_SESSION['$num_type_4'];
            $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_4'];
            $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_4'];
        }else {
            unset($_SESSION['$num_type_4']);
        }
        $_SESSION['sum_price_vat'] = (float)($_SESSION['sum_price'] *1.07);
        $v_booking_date = $_SESSION['$date'];
        $v_total_price = (float)$_SESSION['sum_price'];
        $v_status = "Unpaid";
        $v_total_quantity = $_SESSION['total_quantity'];
        $v_total_price_and_vat = (float)$_SESSION['sum_price_vat'];
        $v_id_t1 = $_SESSION['ticket_kid_1'];
        $v_id_t2 = $_SESSION['ticket_adult_1'];
        $v_id_t3 = $_SESSION['ticket_kid_2'];
        $v_id_t4 = $_SESSION['ticket_adult_2'];
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM USER WHERE email = '$email';";
            $result = mysqli_query($db_con, $sql);
            if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<script>alert('" . $row['first_name'] . "')</script>";
                    $v_user_id = $row['user_id'];
                }
            }
        }
        // ORDERS
        $sql = "INSERT INTO ORDERS (booking_date, total_price, status, total_quantity, total_price_and_vat, user_id) 
         VALUES ('$v_booking_date', '$v_total_price', '$v_status', '$v_total_quantity', '$v_total_price_and_vat', '$v_user_id')";
        $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));

        $sql = "SELECT order_id FROM ORDERS ORDER BY order_id DESC LIMIT 1";
        $result = mysqli_query($db_con, $sql);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $v_order_id = $row['order_id'];
            }
        }
        // SELECT order_id FROM ORDERS ORDER BY user_id DESC LIMIT 1

        if (isset($_SESSION['$num_type_1'])) {
            $v_q_type1 =  $_SESSION['$num_type_1'];
            $sql = "INSERT INTO ORDER_TICKET (order_id, ticket_id, quantity) 
         VALUES ('$v_order_id', '$v_id_t1', '$v_q_type1')";
            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
        }
        if (isset($_SESSION['$num_type_2'])) {
            $v_q_type2 =  $_SESSION['$num_type_2'];
            $sql = "INSERT INTO ORDER_TICKET (order_id, ticket_id, quantity) 
         VALUES ('$v_order_id', '$v_id_t2', '$v_q_type2')";
            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
        }
        if (isset($_SESSION['$num_type_3'])) {
            $v_q_type3 =  $_SESSION['$num_type_3'];
            $sql = "INSERT INTO ORDER_TICKET (order_id, ticket_id, quantity) 
         VALUES ('$v_order_id', '$v_id_t3', '$v_q_type3')";
            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
        }
        if (isset($_SESSION['$num_type_4'])) {
            $v_q_type4 =  $_SESSION['$num_type_4'];
            $sql = "INSERT INTO ORDER_TICKET (order_id, ticket_id, quantity) 
         VALUES ('$v_order_id', '$v_id_t4', '$v_q_type4')";
            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
        }
        $_SESSION['order_id'] = $v_order_id;
        // header("Location: up_payment.php?ok=bro");
        header("Location: up_payment.php?status_payment=detail&".$_SESSION['order_id']."");
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
