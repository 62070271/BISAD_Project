<?php
  include('dbserver.php');
  require_once('function.php');
    

    if (isset($_POST['submit'])) {
      $f_name = $_POST['f_name'];
      $l_name = $_POST['l_name'];
      $Tel = $_POST['Tel'];
      $email = ($_POST['email']);
      $password = $_POST['password'];
      $Repassword = $_POST['pwdRepeat'];
      $gender = $_POST['gender'];
      $yob = $_POST['yfb'];
      $type = 'Customer';

      if (emtyInput($f_name, $l_name, $Tel, $email, $password, $Repassword, $yob) !== false) {
        header("Location:reg_front.php?error=emptyInput");
        exit();
      }

      if (validateEmail($email) !== false) {
        header("Location:reg_front.php?error=invalidEmail");
        exit();
      }

      if (passwordCheck($password, $Repassword) !== false) {
        header("Location:reg_front.php?error=passworddontMatch");
        exit();
      }

      if (emailExit($db_con, $email) !== false) {
        header("Location:reg_front.php?error=emaildoesntExit");
        exit();
      }

      createUser($db_con, $f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type);
    }
    else {
      
      header("Location:reg_front.php");
    }

    // $f_name = "'" . $_POST['f_name'] . "'";
    // $l_name = "'" . $_POST['l_name'] . "'";
    // $Tel = "'" . $_POST['Tel'] . "'";
    // $email = "'" . ($_POST['email']) . "'";
    // $password = "'" . $_POST['password'] . "'";
    // $gender = "'" . $_POST['gender'] . "'";
    // $yob = "'" . $_POST['yfb'] . "'";
    // $type = "'" . 'Customer' . "'";
    // $sql = "INSERT INTO user (first_name, last_name, Tel, email, u_password, gender, year_of_birth, user_type) VALUES ($f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type)";
    
    // if (mysqli_query($db_con, $sql)) {
    //     echo "<script>alert('Register Success :)');</script>";
    //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($db_con);
    //   }
    // header("Location: show.php?signup=success");
    // echo "<script>alert('Register Success :)');</script>";
?>