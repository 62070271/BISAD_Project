<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Test</title>
    <?php
        include('dbserver.php');
        require_once('function.php');

        session_start();
        if(!isset($_SESSION['email'])) {
            header("Location: logIn_front.php");
        }
    ?>
</head>
<body>
    <?php
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM user WHERE email = '$email';";
       

        $result = mysqli_query($db_con, $sql);
        $check_row = mysqli_num_rows($result);

        if ($check_row > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['user_id'];
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $tel = $row['Tel'];
                $mail = $row['email'];
                $pass = $row['u_password'];
                $gender = $row['gender'];
                $year = $row['year_of_birth'];
                $type = $row['user_type'];
            }
        }
        echo "<div style='text-align: center;'>";
            echo "<h2>Edit Your Profile</h2>";

            echo " <form action='' method='POST' onsubmit='' name='edit'>";

                echo "<label>Id: $id </label><br>";
                echo "<br>";

                echo "<label>Role: $type </label><br>";
                echo "<br>";

                echo "<label>Year Of Birth: $year </label><br>";
                echo "<br><br>";

                echo "<label>First Name: </label><br>";
                echo "<input type='text' name='fname' value='$fname'>";
                echo "<br><br>";

                echo "<label>Last Name: </label><br>";
                echo "<input type='text' name='lname' value='$lname'>";
                echo "<br><br>";

                echo "<label>Telephone Number: </label><br>";
                echo "<input type='text' name='tel' value='$tel'>";
                echo "<br><br>";

                echo "<label>E-mail: </label><br>";
                echo "<input type='text' name='mail' value='$mail' disabled>";
                echo "<br><br>";
                
                echo "<label>New Password: </label><br>";
                echo "<input type='password' name='pass1'>";
                echo "<br><br>";
                echo "<label>Confirm Password: </label><br>";
                echo "<input type='password' name='pass2'>";
                echo "<br><br>";

                echo"<button type='submit' name='submit'>OK!</button>";
            echo "</form>";

            echo "<h3><a href='index.php' style='color: blue;'>";
                echo "Go to index.php";
            echo "</a></h3>";

        echo "</div>";

        

        if (isset($_POST['submit'])) {
            
            if (emptyCheck($_POST['fname'], $_POST['lname'], $_POST['tel']))
            {
                header("Location: Editprofile.php?error=emptyinput");
                exit();
            }

            if (passwordCheck($_POST['pass1'], $_POST['pass2'])){

                header("Location: Editprofile.php?error=PasswordnotMatch");
                exit();
            }

            if ($_POST['pass1']  != "")
            {
                $n_pass = $_POST['pass1'];
            }
            else
            {
                $n_pass =  $pass;
            }
           
            $n_fname = $_POST['fname'];
            $n_lname = $_POST['lname'];
            $n_tel = $_POST['tel'];
            
            // SQL UPDATE VALUES
            $sql = "UPDATE user SET
                first_name = '$n_fname',
                last_name = '$n_lname',
                Tel = '$n_tel',
                u_password = '$n_pass'
            WHERE email = '$email';
            ";

            $result = mysqli_query($db_con, $sql);
            mysqli_close($db_con);

            // Check Result
            if ($result) 
            {
                header("Location: Editprofile.php?error=none");
            }

        }
    ?>


    <?php
        function emptyCheck($fname, $lname, $tel) 
        {
            if(empty($fname) || empty($lname) || empty($tel))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    ?>

    <?php
            if (isset($_GET["error"])) {
                if (($_GET["error"]) == "emptyinput") {
                    echo "<script>alert('Fill in all fields!')</script>";
                }
                else if (($_GET["error"]) == "PasswordnotMatch") {
                    echo "<script>alert('Password not Match')</script>";
                }
                else if (($_GET["error"]) == "none") {
                    echo "<script>alert('Update Success!')</script>";
                }
                else {
                    echo "";
                }
            }
    ?>
</body>
</html>