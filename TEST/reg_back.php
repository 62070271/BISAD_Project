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
      $user_imgdf = 'user_default.png';

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

      if(strlen($Tel) != 10)
      {
        header("Location:reg_front.php?error=wrongTelephonenumber");
        exit();
      }

      createUser($db_con, $f_name, $l_name, $Tel, $email, $password, $gender, $yob, $type, $user_imgdf);
    }
    
    else {
      
      header("Location: reg_front.php");
    }
?>