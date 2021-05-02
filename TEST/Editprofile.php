<?php
include('dbserver.php');
require_once('function.php');
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: logIn_front.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="main_css.css">
    <!-- jquery for preview image -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Font Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!-- Font Rammetto -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- icon -->
    <link rel="shortcut icon" type="image/x-icon" class="rounded-circle" href="Web_Image/Logo_Web.ico" />

    <title>Edit Profile</title>
    <style>
        body {
            background-image: url('https://ae01.alicdn.com/kf/HTB1ttqNbv5TBuNjSspmq6yDRVXa0/Home-decoration-deer-antler-white-wild-life-animal-black-background-Silk-Fabric-Poster-Print-DW335.jpg');
            background-repeat: no-repeat;
            /* background-position: center; */
            background-size: 120% 120%;
            background-attachment: fixed;
            background-position-x: -40vh;
            background-position-y: -20vh;
        }
    </style>
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
            $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
            $_SESSION['user_image'] = $row['user_image'];
        }
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    if (isset($_SESSION['email'])) {
        if ($_SESSION['user_type'] == 'Financial') {
            header("Location: prove.php?status=loggedIn.php");
        }
        if ($_SESSION['user_type'] == 'Reception') {
            echo '<script>alert("yess")</script>';
            header("Location: scanner.php?status=loggedIn.php");
        }
        $user_name = $_SESSION['user_name'];
        $user_image = $_SESSION['user_image'];
    }
    ?>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top mb-5" style="background-color: #395902;">
        <div class="container">
            <a class="navbar-brand rammeto" href="index.php">
                <img src="Web_Image/Logo300X300v4.png" alt="" width=" 32" height="32" class="d-inline-block align-text-top rounded-circle">
                ZOO
            </a>
            <!-- dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FBB03B;">
                    <img src='user_images/<?php echo $_SESSION["user_image"] ?>' alt='' width='25' height='25' class='d-inline-block align-text-top rounded-circle'>&nbsp<?php echo $_SESSION['user_name'] . ' '; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="Profile&QR_Code.php">Profile & QR Code</a></li>
                    <li><a class="dropdown-item" href="Editprofile.php">Edit profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="index.php?logout=1">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mb-5">
        <div class="my-5">
            <h1 class="card-title text-center rammeto ptyellow">Edit Profile</h1>
        </div>
        <div class='row'>
            <div class="col-3"></div>
            <div class='col-6'>
                <div class="card p-4 mx-auto" style="width: 80%">
                    <div class="card-body">
                        <form action='' method='POST' onsubmit='' name='edit' enctype='multipart/form-data'>

                            <img id="previewImg" src="user_images/<?php echo $img ?>" width='200' name='pic' height='200' style='margin-left: auto; display: block; margin-right: auto; border-radius: 50%;'>
                            <br><br>

                            <label class="form-label">Upload Profile Picture: </label><br>
                            <input onchange="previewFile(this)" class="form-control" type="file" name="user_img" require accept="image/*">
                            <input type="file" class="form-control" type='text' name='user_currentimg' value='<?php echo $img ?>' style='display:none;'>
                            <br>

                            <!-- Preview image before submit -->
                            <script>
                                function previewFile(input) {
                                    var file = $("input[type=file]").get(0).files[0];

                                    if (file) {
                                        var reader = new FileReader();

                                        reader.onload = function() {
                                            $("#previewImg").attr("src", reader.result);
                                        }

                                        reader.readAsDataURL(file);
                                    }
                                }
                            </script>

                            <label class="form-label">First Name: </label><br>
                            <input class="form-control" type='text' name='fname' value='<?php echo $fname ?>'>
                            <br>

                            <label class="form-label">Last Name: </label><br>
                            <input class="form-control" type='text' name='lname' value='<?php echo $lname ?>'>
                            <br>
                            <label class="text-center mb-1 form-label">Year Of Birth:&nbsp<?php echo $year ?></label><br><br>
                            <label class="form-label">Telephone Number: </label><br>
                            <input class="form-control" type='text' name='tel' value='<?php echo $tel ?>'>
                            <br>

                            <label class="form-label">E-mail: </label><br>
                            <input class="form-control" type='text' name='mail' value='<?php echo $mail ?>' disabled>
                            <br>

                            <label class="form-label">New Password: </label><br>
                            <input class="form-control" type='password' name='pass1'>
                            <br>
                            <label class="form-label">Confirm Password: </label><br>
                            <input class="form-control" type='password' name='pass2'>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-center align-items-center">
                                    <button class="btn btn-primary rammeto px-3" type="submit" name='submit'>Save</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
            <div class="col-3"></div>
        </div>

    </div>
    </div>
    <?php
    // echo $img;
    // echo "<div style='text-align: center;'>";
    // echo "<h2>Edit Your Profile</h2>";

    // echo " <form action='' method='POST' onsubmit='' name='edit' enctype='multipart/form-data'>";

    // echo "<img src='user_images/" . $img . "' width='150' name='pic' height='150' style='border-radius: 50%;'>";
    // echo "<br><br>";

    // echo '<input type="file" name="user_img"  require accept="image/*">';
    // echo "<input type='text' name='user_currentimg' value='$img' style='display:none;'>";
    // echo "<br><br>";

    // echo "<label>Id: $id </label><br>";
    // echo "<br>";

    // echo "<label>Role: $type </label><br>";
    // echo "<br>";

    // echo "<label>Year Of Birth: $year </label><br>";
    // echo "<br><br>";

    // echo "<label>First Name: </label><br>";
    // echo "<input type='text' name='fname' value='$fname'>";
    // echo "<br><br>";

    // echo "<label>Last Name: </label><br>";
    // echo "<input type='text' name='lname' value='$lname'>";
    // echo "<br><br>";

    // echo "<label>Telephone Number: </label><br>";
    // echo "<input type='text' name='tel' value='$tel'>";
    // echo "<br><br>";

    // echo "<label>E-mail: </label><br>";
    // echo "<input type='text' name='mail' value='$mail' disabled>";
    // echo "<br><br>";

    // echo "<label>New Password: </label><br>";
    // echo "<input type='password' name='pass1'>";
    // echo "<br><br>";
    // echo "<label>Confirm Password: </label><br>";
    // echo "<input type='password' name='pass2'>";
    // echo "<br><br>";

    // echo "<button type='submit' name='submit'>OK!</button>";
    // echo "</form>";

    // // $_SESSION['user_image'] = $img;
    // echo "<h3><a href='index.php' style='color: blue;'>";
    // echo "Go to index.php";
    // echo "</a></h3>";

    // echo "</div>";




    if (isset($_POST['submit'])) {
        $current_img = $_POST['user_currentimg'];

        // NEW USER IMG (POST METHOD)
        $new_img = $_FILES['user_img']['name'];

        // HAVE NEW USER IMG
        if ($new_img != "") {

            // PATH FOR CONTAIN USER IMG FILES
            $path = "user_images/";

            // CUT IMG NAME KEEP ONLY FILE LAST NAME (PGN, JPG, ...)
            $type = strrchr($_FILES['user_img']['name'], '.');

            // SET DATE 
            date_default_timezone_set('Asia/Bangkok');
            $date = date("Ymd");

            // RANDOM NUMBER
            $numrand = (mt_rand());
            // SET NEW IMG NAME
            $user_image =  $date . $numrand . $type;
            $pathCopy = $path . $user_image;
            $pathLink = 'user_images/' . $user_image;
            // KEEP IMG FILE TO FLODER
            move_uploaded_file($_FILES['user_img']['tmp_name'], $pathCopy);
        }
        // HAVE NO NEW ING
        else {
            // OLD IMG
            $user_image = $img;
        }


        if (strlen($_POST['tel']) != 10) {
            header("Location: Editprofile.php?error=wrongTelephonenumber");
            exit();
        }

        if (emptyCheck($_POST['fname'], $_POST['lname'], $_POST['tel'])) {
            header("Location: Editprofile.php?error=emptyinput");
            exit();
        }

        if (passwordCheck($_POST['pass1'], $_POST['pass2'])) {

            header("Location: Editprofile.php?error=PasswordnotMatch");
            exit();
        }

        if ($_POST['pass1']  != "") {
            $n_pass = $_POST['pass1'];
        } else {
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
        header("Location: Editprofile.php?error=none");
        // Check Result
        if ($result) {
            // header("Location: Editprofile.php?error=none");
        }
        mysqli_close($db_con);
    }
    ?>


    <?php
    function emptyCheck($fname, $lname, $tel)
    {
        if (empty($fname) || empty($lname) || empty($tel)) {
            return true;
        } else {
            return false;
        }
    }
    ?>

    <?php
    if (isset($_GET["error"])) {
        if (($_GET["error"]) == "emptyinput") {
            echo "<script>alert('Fill in all fields!')</script>";
        } else if (($_GET["error"]) == "PasswordnotMatch") {
            echo "<script>alert('Password not Match')</script>";
        } else if (($_GET["error"]) == "none") {
            echo "<script>alert('Update Success!')</script>";
        } else if (($_GET["error"]) == "wrongTelephonenumber") {
            echo "<script>alert('The phone number should be 10 characters.')</script>";
        } else {
            echo "";
        }
    }
    ?>

</body>
<!-- Footer -->
<footer class="text-center text-lg-start text-light mt-5" style="background-color: #395902;">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">ที่มาของสวนสัตว์</h5>

                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สวนสัตว์คนพันธุ์เสือ ได้นำสวนสัตว์เข้ามาผสมผสานกับความสมบูรณ์ของ
                    ป่าไม้ภายในพื้นที่โดยใช้การอนุรักษ์และหาประโยชน์จากสภาพผืนป่าแบบระมัดระวังและรอบคอบ
                    ไม่ให้มีการเปลี่ยนแปลงสภาพพื้นที่ของป่า และลดการทำลายสภาพพื้นที่เดิมให้มากที่สุด
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">ข้อมูลเพิ่มเติม</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a class="fttf text-light" href="#!">ข้อกำหนดและเงื่อนไข</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">นโยบายความเป็นส่วนตัว</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">บริการช่วยเหลือ</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">ติดต่อเรา</h5>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <a class="text-light" href="#!"><svg width="30" height="30" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="line" class="svg-inline--fa fa-line fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M272.1 204.2v71.1c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.1 0-2.1-.6-2.6-1.3l-32.6-44v42.2c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.8 0-3.2-1.4-3.2-3.2v-71.1c0-1.8 1.4-3.2 3.2-3.2H219c1 0 2.1.5 2.6 1.4l32.6 44v-42.2c0-1.8 1.4-3.2 3.2-3.2h11.4c1.8-.1 3.3 1.4 3.3 3.1zm-82-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 1.8 1.4 3.2 3.2 3.2h11.4c1.8 0 3.2-1.4 3.2-3.2v-71.1c0-1.7-1.4-3.2-3.2-3.2zm-27.5 59.6h-31.1v-56.4c0-1.8-1.4-3.2-3.2-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 .9.3 1.6.9 2.2.6.5 1.3.9 2.2.9h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.7-1.4-3.2-3.1-3.2zM332.1 201h-45.7c-1.7 0-3.2 1.4-3.2 3.2v71.1c0 1.7 1.4 3.2 3.2 3.2h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2V234c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2v-11.4c-.1-1.7-1.5-3.2-3.2-3.2zM448 113.7V399c-.1 44.8-36.8 81.1-81.7 81H81c-44.8-.1-81.1-36.9-81-81.7V113c.1-44.8 36.9-81.1 81.7-81H367c44.8.1 81.1 36.8 81 81.7zm-61.6 122.6c0-73-73.2-132.4-163.1-132.4-89.9 0-163.1 59.4-163.1 132.4 0 65.4 58 120.2 136.4 130.6 19.1 4.1 16.9 11.1 12.6 36.8-.7 4.1-3.3 16.1 14.1 8.8 17.4-7.3 93.9-55.3 128.2-94.7 23.6-26 34.9-52.3 34.9-81.5z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a class="text-light" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg></a>
                    </div>
                    <div class="col-sm-3">
                        <a class="text-light" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg></a>
                    </div>
                    <div class="col-sm-3">
                        <a class="text-light" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                            </svg></a>
                    </div>
                </div>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #284001;">
        © 2021 Copyright:
        <a class="text-light" href="#!">คนพันธุ์เสือ</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

</html>