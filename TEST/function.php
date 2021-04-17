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

    function createUser($db_con, $f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type) {
      $sql = "INSERT INTO USER (first_name, last_name, Tel, email, user_password, gender, year_of_birth, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
      $prePair = mysqli_stmt_init($db_con);

      if(!mysqli_stmt_prepare($prePair, $sql)) {
        header("Location: reg_front.php?error=stmt_prepare_failed");
        exit();
      }

      mysqli_stmt_bind_param($prePair, "ssssssss", $f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type);
      mysqli_stmt_execute($prePair);
      mysqli_stmt_close($prePair);

      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['user_name'] = $f_name . ' ' . $l_name;

      header("Location: index.php?status=loggedIn");
      exit();
    }



    // CREATE QR CODES
    function createQRcode($slip_id, $order_id, $user_id)
    {
      require_once('phpqrcode/qrlib.php');
        
      // DATABASE CONNECTION
      $server_name = 'freedb.tech';
      $user_name = 'freedbtech_Weeravat';
      $user_password = 'KLIptp17';
      $db_name = 'freedbtech_BISADProject';
      $db_con =  mysqli_connect($server_name, $user_name, $user_password, $db_name) or die("Unable Connect");
        

        $sql = "SELECT *
                FROM USER AS U
                INNER JOIN ORDERS AS O
                ON U.user_id = O.user_id
                INNER JOIN SLIP_OF_PAYMENT AS S
                ON O.order_id = S.order_id
                INNER JOIN CONFIRM_SLIP AS C
                ON S.slip_id = C.slip_id
                WHERE S.slip_id = '$slip_id'
                AND O.order_id = '$order_id';";

        $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));
        $check_row = mysqli_num_rows($result);

        if($check_row > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $confirm_id = $row['confirm_id'];
                $order_id = $row['order_id'] . ',';
                $user_fname = $row['first_name'] . ',';
                $user_lname = $row['last_name'] . ',';
                $booking =  $row['booking_date'] . ',';
                $quntity = $row['total_quantity'] . ',';
            }
        }
        else
        {
            echo 'Not found!';
            return false;
        }


        $path = 'qrcodes/';
        $file = $path.uniqid().".png";
        $file_name = substr($file, 8);

        $txt = $confirm_id . $user_fname . $user_lname . $booking . $quntity;
        QRcode::png($txt, $file);

        $sql2 = "INSERT INTO QR_CODE (confirm_id, qrcode_status, qr_code, user_id) VALUES ('$confirm_id', '1', '$file_name', '$user_id');";

        $result2 = mysqli_query($db_con, $sql2) or die ("Error in query: $sql " . mysqli_error($db_con));

        if($result2){return true;}
        
        mysqli_close($db_con);
    }



    function updateOrderStatus($order_id)
    {
      // DATABASE CONNECTION
      $server_name = 'freedb.tech';
      $user_name = 'freedbtech_Weeravat';
      $user_password = 'KLIptp17';
      $db_name = 'freedbtech_BISADProject';
      $db_con =  mysqli_connect($server_name, $user_name, $user_password, $db_name) or die("Unable Connect");

      $sql = "UPDATE ORDERS SET status='Complete' WHERE order_id='$order_id';";
      $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));
      if($result){return true;}
      else{return false;}

      mysqli_close($db_con);
    }
?>