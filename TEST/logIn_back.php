<?php
    session_start();
    include('dbserver.php');
    if(isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($db_con, $_POST['email']) ;
        $pass = mysqli_real_escape_string($db_con, $_POST['password']);

        require_once('function.php');

        if (emptyLogin($email, $pass) !== false) {
            header("Location: logIn_front.php?error=emty_input_login");
            exit();
        }

        // userLogin($db_con, $email, $pass);

        $sql = "SELECT * FROM USER WHERE email = '$email' AND user_password = '$pass'";
        $result = mysqli_query($db_con, $sql);

        if (mysqli_num_rows($result) == 1) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "<script>alert('" . $row['first_name'] . "')</script>";
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
                $_SESSION['user_image'] = $row['user_image'];
                $_SESSION['user_type'] = $row['user_type'];
                
            }
            
            
            $_SESSION['success'] = "You are now logged in.";
            header("Location: index.php?status=loggedIn");
            // if (isset($_SESSION['type_user']) == 'Customer') {
            //     header("Location: index.php?status=loggedIn");
            // }
            // if (isset($_SESSION['type_user']) == 'Financual') {
            //     header("Location: prove.php?status=loggedIn");
            // }
            
        }
        else {
            // $_SESSION['error'] = "";
            header("Location: logIn_front.php?error=Wrongemailorpassword!");
        }
    }
    else {
        header("Location: logIn_front.php");
        exit();
    }

    $result;
    function emptyLogin($email, $pass) {
    if (empty($email) || empty($pass) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
    }


?>