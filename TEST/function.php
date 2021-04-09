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
      $sql = "SELECT * FROM user WHERE email = ?;";
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
      $sql = "INSERT INTO user (first_name, last_name, Tel, email, u_password, gender, year_of_birth, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
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





<!-- LOG IN -->
<?php
    // $result;
    // function emptyLogin($email, $pass) {
    // if (empty($email) || empty($pass) ) {
    //     $result = true;
    // }
    // else {
    //     $result = false;
    // }
    // return $result;
    // }

    // function userLogin($db_con, $email, $pass){
    //     $emailExit = emailExit($db_con, $email);

    //     if ($emailExit === false) {
    //         header("Location: logIn(front).php?error=email_wrong");
    //         exit();
    //     }

    //     $sql = "SELECT * FORM user WHERE email = '$email' AND u_password = '$pass'";
    //     $result = mysqli_query($db_con, $sql);
    //     echo $result['first_name'];

    //     if (mysqli_num_rows($result) == 1) {
    //         $_SESSION['user_id'] = $result['user_id'];
    //         $_SESSION['first_name'] = $result['first_name'];
    //         $_SESSION['success'] = "You aer now logged in.";
    //         header("Location: logIn(front).php?status=loggedIn");
            
    //     }
    //     else {
    //         header("Location: logIn(front).php?status=wrongPassword");
    //         exit();
    //     }

    //     // $password = $emailExit['u_password'];
    //     // $checkPassword = password_verify($pass, $password);

    //     // if ($checkPassword === false) {
    //     //     header("Location: logIn(front).php?error=Passwordwrong");
    //     //     exit();
    //     // }
    //     // else if ($checkPassword === true) {
    //     //     session_start();
    //     //     $_SESSION['user_id'] = $emailExit['user_id'];
    //     //     header("Location: logIn(front).php?user_id=" . "'$_SESSION[user_id]'");
    //     //     exit();
    //     // }
    // }
?>