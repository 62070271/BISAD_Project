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
?>