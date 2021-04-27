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
        $sql = "SELECT * FROM USER WHERE email = '$email';";
       

        $result = mysqli_query($db_con, $sql);
        $check_row = mysqli_num_rows($result);

        if ($check_row > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['user_id'];
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $tel = $row['Tel'];
                $mail = $row['email'];
                $pass = $row['user_password'];
                $gender = $row['gender'];
                $year = $row['year_of_birth'];
                $type = $row['user_type'];
                $img = $row['user_image'];
            }
        }
        // echo $img;
        echo "<div style='text-align: center;'>";
            echo "<h2>Edit Your Profile</h2>";

            echo " <form action='' method='POST' onsubmit='' name='edit' enctype='multipart/form-data'>";

                echo "<img src='user_images/" . $img . "' width='150' name='pic' height='150' style='border-radius: 50%;'>";
                echo "<br><br>";

                echo '<input type="file" name="user_img"  require accept="image/*">';
                echo "<input type='text' name='user_currentimg' value='$img' style='display:none;'>";
                echo "<br><br>";

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

            $_SESSION['user_image'] = $img;
            echo "<h3><a href='index.php' style='color: blue;'>";
                echo "Go to index.php";
            echo "</a></h3>";

        echo "</div>";

        

        if (isset($_POST['submit'])) {

            $current_img = $_POST['user_currentimg'];
            $new_img = $_FILES['user_img']['name'];

            if($new_img != "")
            {
                $path = "user_images/";

                $type = strrchr($_FILES['user_img']['name'], '.');

                date_default_timezone_set('Asia/Bangkok');
                $date = date("Ymd");

                $numrand = (mt_rand());
                $user_image =  $date . $numrand . $type;
                $pathCopy = $path . $user_image;
                $pathLink = 'user_images/' . $user_image;

                move_uploaded_file($_FILES['user_img']['tmp_name'], $pathCopy);
            }
            else
            {
                $user_image = $current_img;
            }
            

            if(strlen($_POST['tel']) != 10)
            {
                header("Location: Editprofile.php?error=wrongTelephonenumber");
                exit();
            }

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
            $sql = "UPDATE USER 
                    SET
                        first_name = '$n_fname',
                        last_name = '$n_lname',
                        Tel = '$n_tel',
                        user_password = '$n_pass',
                        user_image = '$user_image'
                    WHERE email = '$email';";

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
                else if(($_GET["error"]) == "wrongTelephonenumber"){
                    echo "<script>alert('The phone number should be 10 characters.')</script>";
                }
                else {
                    echo "";
                }
            }
    ?>
</body>
</html>