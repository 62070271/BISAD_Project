<!-- REGISTER -->
<?php
    include('dbserver.php');
    
    $result;
    function emtyInput($f_name, $l_name, $Tel, $email, $password, $Repassword, $yob) {
      if (empty($f_name) || empty($l_name) || empty($Tel) || empty($email) || empty($password) || empty($Repassword) || empty($yob)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

    function validateEmail($email) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

    function passwordCheck($password, $Repassword) {
      if($password !== $Repassword) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

    function emailExit($db_con, $email) {
      $sql = "SELECT * FROM USER WHERE email = ?;";
      $prePair = mysqli_stmt_init($db_con);

      if(!mysqli_stmt_prepare($prePair, $sql)) {
        header("Location: reg_front.php?error=stmt_prepare_failed");
        exit();
      }

      mysqli_stmt_bind_param($prePair, "s", $email);
      mysqli_stmt_execute($prePair);

      $resultData = mysqli_stmt_get_result($prePair);
      if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
      }
      else {
        $result = false;
        return $result;
      }

      mysqli_stmt_close($prePair);
    }


    function createUser($db_con, $f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type, $user_imgdf) {

      $sql = "INSERT INTO USER (first_name, last_name, Tel, email, user_password, gender, year_of_birth, user_type, user_image) 
              VALUES ('$f_name', '$l_name', '$Tel', '$email', '$password', '$gender', '$yob', '$type', '$user_imgdf');";

      $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));

      if($result) {
        
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['user_name'] = $f_name . ' ' . $l_name;
        $_SESSION['user_image'] = $user_imgdf;
        $_SESSION['user_type'] = $type;
        header("Location: index.php?status=loggedIn");
      }
      else{
        header("Location: reg_front.php?error=stmt_prepare_failed");
        exit();
      }

    }



    // CREATE QR CODES
    function createQRcode($slip_id, $order_id, $user_id, $db_con)
    {
      require_once('phpqrcode/qrlib.php');
        
      $sql = "SELECT *
              FROM USER AS U
              INNER JOIN ORDERS AS O
              USING (user_id)
              INNER JOIN SLIP_OF_PAYMENT AS S
              USING (order_id)
              INNER JOIN CONFIRM_SLIP AS C
              USING (slip_id)
              WHERE S.slip_id = '$slip_id'
              AND O.order_id = '$order_id';
              ";

        $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));
        $check_row = mysqli_num_rows($result);

        if($check_row > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $confirm_id_use = $row['confirm_id'];
                $confirm_id = $row['confirm_id'] . ',';
                $order_id = $row['order_id'] . ',';
                $user_fname = $row['first_name'] . ',';
                $user_lname = $row['last_name'] . ',';
                $booking =  $row['booking_date'] . ',';
                $quntity = $row['total_quantity'];
            }
        }
        else
        {     
          return false;
        }


        $path = 'qrcodes/';
        $file = $path.uniqid().".png";
        $file_name = substr($file, 8);

        $txt = $confirm_id . $user_fname . $user_lname . $booking . $quntity;
        QRcode::png($txt, $file);

        $sql2 = "INSERT INTO QR_CODE (confirm_id, qrcode_status, qr_code, user_id) VALUES ('$confirm_id_use', '1', '$file_name', '$user_id');";

        $result2 = mysqli_query($db_con, $sql2) or die ("Error in query: $sql2" . mysqli_error($db_con));

        if($result2){return true;}
        
        mysqli_close($db_con);
    }



    function updateOrderStatus($order_id, $db_con)
    {
      $sql = "UPDATE ORDERS 
              SET status='Complete' 
              WHERE order_id='$order_id';
              ";
      $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));
      if($result){return true;}
      else{return false;}
      mysqli_close($db_con);
    }





    function addToSummary($db_con)
    {
      // FIND latest confirm_id
      $sql = "SELECT confirm_id
      FROM CONFIRM_SLIP
      ORDER BY confirm_id DESC 
      LIMIT 1;
      ";
      $result1 = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
      $check_row = mysqli_num_rows($result1);

      if ($check_row > 0) 
      {
        $row = mysqli_fetch_assoc($result1);
        $confirm_id = $row['confirm_id'];
      }
      else {echo '0 rows';}
      
      // GET ORDER DETAILS DATA WHEN APPROVE 
      $sql = "SELECT CS.confirm_id, O.booking_date, OT.ticket_id, SUM(OT.quantity) AS tk_type, O.total_price_and_vat, O.total_quantity
      FROM CONFIRM_SLIP AS CS
      INNER JOIN SLIP_OF_PAYMENT AS SP
      USING (slip_id)
      INNER JOIN ORDERS AS O
      USING (order_id)
      INNER JOIN ORDER_TICKET AS OT
      USING (order_id)
      GROUP BY CS.confirm_id, OT.ticket_id
      HAVING CS.confirm_id = '$confirm_id'
      ";

      $result2 = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
      $check_row = mysqli_num_rows($result2);

      $quantity_th_kid = 0;
      $quantity_th_ad = 0;
      $quantity_fk_kid = 0;
      $quantity_fk_ad = 0;

      if ($check_row > 0) 
      {
        while($row = mysqli_fetch_assoc($result2))
        {
        $booking_date = $row['booking_date'];
        $income = $row['total_price_and_vat'];
        $t_quantity = $row['total_quantity'];
      
        if ($row['ticket_id'] == 1) { $quantity_th_kid = $row['tk_type']; }
        else if ($row['ticket_id'] == 2) { $quantity_th_ad = $row['tk_type']; }
        else if ($row['ticket_id'] == 5) { $quantity_fk_kid = $row['tk_type']; }
        else if ($row['ticket_id'] == 6) { $quantity_fk_ad = $row['tk_type']; }

        }
      }
      else {echo '0 rows';}


      $insert = "INSERT INTO SUMMARY_ACCOUNT (confirm_id, income, date_booking, count_of_sale_ticket, count_thai_kid_ticket, count_thai_adult_ticket, count_foreigner_kid_ticket, count_foreigner_adult_ticket)
                  VALUES ('$confirm_id', '$income', '$booking_date', '$t_quantity', ' $quantity_th_kid', '$quantity_th_ad', '$quantity_fk_kid', '$quantity_fk_ad');";
      $result3 = mysqli_query($db_con, $insert) or die("Error in query: $insert " . mysqli_error($db_con));

      if($result1 && $result2 && $result3) 
      {
        return true;
      }
      else
      {
        return false;
      }
    }


    // UPDATE ORDER STATUS BY DATE
    function auto_update_order_stutus($db_con)
    {
      // FIND CURRENT DATE
      date_default_timezone_set('Asia/Bangkok');
      $current_date = date("Y-m-d");

      // UPDATE ORDER STATUS WHEN UPLOAD SLIP IN SAME DATE BOOKING DATE OR UPLOAD SLIP AFTER BOOKING DATE.
      // UPDATE ORDER STATUS WHEN DIDN'T UPLOAD SLIP UNTIL BOOKING DATE ARRIVED.
      // YOU SHOULD UPLOAD YOUR SLIP OF PAYMENT AS LATE 1 DAY BEFORE THE RESERVATION DATE.
      $sql = "UPDATE ORDERS AS O
              LEFT JOIN SLIP_OF_PAYMENT AS SP
              USING (order_id)
              SET O.status = 'Fail'
              WHERE SP.time_stamp >= O.booking_date OR (SP.slip_id IS NULL AND O.booking_date <= '$current_date');
              ";
      mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
    }



    // AUTO UPDATE QR CODE STATUS ---> Profile and QR Code
    function auto_update_qr_status($db_con)
    {
      // FIND CURRENT DATE
      date_default_timezone_set('Asia/Bangkok');
      $current_date = date("Y-m-d");

      $sql = "UPDATE  QR_CODE AS Q
              INNER JOIN CONFIRM_SLIP AS CS
              USING (confirm_id)
              INNER JOIN SLIP_OF_PAYMENT AS SP
              USING (slip_id)
              INNER JOIN ORDERS AS O
              USING (order_id)
              SET Q.qrcode_status = '2'
              WHERE O.booking_date < '$current_date'
              AND Q.qrcode_status = '1'  
      ;";
      mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
    }
?>