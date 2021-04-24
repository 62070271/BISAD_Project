<?php
session_start();
include('dbserver.php');

/* back*/
if (isset($_POST['upload_payment'])) {
    // $_SESSION['$date']
    $v_booking_date = $_SESSION['$date'];
    $v_total_price = (float)$_SESSION['sum_price'];
    $v_status = "Not_payment_yet";
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
    header("Location: index.php?".$_SESSION['order_id']."");
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
