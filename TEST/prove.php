<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php

    include('dbserver.php');
    require_once('function.php');

    ob_start();
    session_start();

    $sql = "SELECT *
                FROM CONFIRM_SLIP AS CS
                RIGHT OUTER JOIN SLIP_OF_PAYMENT AS SP
                ON CS.slip_id = SP.slip_id
                INNER JOIN ORDERS AS O
                ON O.order_id = SP.order_id
                WHERE CS.slip_id IS NULL
                AND SP.is_check <> '1';";

    $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
    $check_row = mysqli_num_rows($result);


    ?>

    <title>Prove Statement</title>
    <style>
        .qr-code {
            max-width: 200px;
            margin: 10px;

        }

        /* body{
            background-image: url('https://images.pexels.com/photos/33045/lion-wild-africa-african.jpg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');
            background-size: cover;
        } */

        .zoom {
            transition: transform .2s;
            /* Animation */
            /* margin: 0 auto; */
        }

        .zoom:hover {
            transform: scale(1.75);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        html {
            scroll-behavior: smooth;
        }

        .homepage_name {
            font-family: 'Rammetto One', cursive;
        }

        /* #nav-link2 {
            margin-left: 40px;
        } */
    </style>
</head>

<body>
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    if (isset($_SESSION['email'])) {
        // if ($_SESSION['user_type'] == 'Financial') {
        //     echo '<script>alert("yess")</script>';
        //     header("Location: prove.php?status=loggedIn.php");
        // }
        // if ($_SESSION['user_type'] == 'Reception') {
        //     echo '<script>alert("yess")</script>';
        //     header("Location: scanner.php?status=loggedIn.php");
        // }
        $user_name = $_SESSION['user_name'];
        $user_image = $_SESSION['user_image'];
    }
    ?>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #395902;">
            <div class="container">
                <a class="navbar-brand" href="index.php?status=loggedIn">
                    <img src="images/20210413885810631.jpg" alt="" width=" 30" height="30" class="d-inline-block align-text-top border border-white rounded-circle">
                    ZOO
                </a>
                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item" class="navbar-nav me-auto mb-2 mb-lg-0">
                                <a id='nav-link1' class="nav-link shadow-sm text-white" class='shadow-lg  align-text-top' href="prove.php?status=loggedIn"><b>Prove</b><span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item text-white">
                                <a id='nav-link2' class="nav-link shadow-sm text-white" class='align-text-top' href="summary_front.php?status=loggedIn"><b>Summary</b><span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FBB03B;"><?php echo "<img src='user_images/$user_image' alt='' width='30' height='30' class='d-inline-block align-text-top border border-dark rounded-circle'>"; ?>&nbsp;<?php echo "$user_name"; ?></a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Profile+QR_Code.php">Profile & QR Code</a></li>
                            <li><a class="dropdown-item" href="Editprofile.php">Edit profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="index.php?logout=1">Log out</a></li>
                        </ul>
                    </div>
                <?php
                } else if (!isset($_SESSION['email'])) {
                ?>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link rounded text-dark" href="logIn_front.php" style="background-color: #FBB03B;">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="reg_front.php">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                <?php
                    header("Location: login_front.php?pleaseLogin");
                }
                ?>
            </div>
        </nav>
    </div>



    <div class="container  table-responsive" style="font-family: 'Kanit', sans-serif;">

        <?php
        // $QR = '<img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive">';
        // echo $QR;
        ?>
        <div class="row mb-5" style="min-height: 750px;">
            <div class="col">
                <h2 class="text-center my-4" style="color:#395902;">Prove Statement</h2>

                <table class="table table table-striped table-hover mb-5" style="z-index: 1; border-radius: 25px;">

                    <thead class="text-center" style="position: sticky;">
                        <!-- <tr class="py-3" style="color:#FBB03B; background-color: #395902; font-size: 15px;"> -->
                        <tr class="py-3" style="font-size: 20px;">
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Total price (vat 7 %)</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Slip TimeStamp</th>
                            <th scope="col">Slip of Payment</th>
                            <th scope="col">Confirm</th>
                            <th scope="col">Deny</th>
                        </tr>
                    </thead>


                    <tbody class="text-center text-dark">

                        <?php
                        if ($check_row > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";

                                echo "<p value='" . $row['slip_id'] . "'></p>";
                                echo "<th name='" . $row['order_id'] . "' value ='" . $row['order_id'] . "' scope='row' style='padding-top:75px;'>" . $row['order_id'] . "</th>";
                                echo "<th style='padding-top:90px;' scope='row'>" . $row['user_id'] . "</th>";
                                echo "<td style='padding-top:90px;'>" . $row['total_price_and_vat'] . "</td>";
                                echo "<td style='padding-top:90px;'>" . $row['booking_date'] . "</td>";
                                echo "<td style='padding-top:90px;'>" . $row['time_stamp'] . "</td>";
                                echo "<td>" . "<img class='zoom' src='images/" . $row['picture'] . "' width='200px' height='200px' alt='' class='slip'>" . "</td>";
                                echo "<td style='padding-top:90px;'>" . "<a href='' id='x" . $row['slip_id'] . "' class='header btn btn-success btn-lg' onclick='return x(" .  $row['slip_id'] . "," . $row['order_id'] . "," .  $row['user_id']  . ")'>Confirm</a>" . "</td>";
                                echo "<td style='padding-top:90px;'>" . "<a href='' id='y" . $row['slip_id'] . "' class='header btn btn-danger btn-lg' onclick='return y(" .  $row['slip_id'] . "," . $row['order_id'] . "," .  $row['user_id']  . ")'>Cancel</a>" . "</td>";

                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
        <script>
            function x(slip_id, order_id, user_id) {
                if (confirm("Do want to confirm this\nOrder ID: " + order_id + "\nSlip ID: " + slip_id)) {
                    document.getElementById('x' + slip_id).href = 'prove.php?orderID=' + order_id + '&slipID=' + slip_id + '&userID=' + user_id + '&status=Confirm';
                } else {
                    document.getElementById('x' + slip_id).href = 'prove.php?orderID=' + order_id + '&slipID=' + slip_id + '&userID=' + user_id + '&status=CancelConfirm';
                    alert('CancelConfirm!');
                }
            }

            function y(slip_id, order_id) {
                if (confirm("Do want to Confirm Deny this\nOrder ID: " + order_id + "\nSlip ID: " + slip_id)) {
                    document.getElementById('y' + slip_id).href = 'prove.php?orderID=' + order_id + '&slipID=' + slip_id + '&status=ConfirmDeny';
                } else {
                    document.getElementById('y' + slip_id).href = 'prove.php?CancelDeny';
                    alert('CancelDeny');
                }
            }
            // function fong()
            // {
            //     setTimeout(function(){console.log(document.getElementById('Deny').href ='prove.php')}, 2000);
            // }
        </script>

        <?php
        
            if (isset($_GET['status'])) 
            {
                $status = $_GET['status'];
                if ($status == 'Confirm') 
                {
                    $slip_id = $_GET['slipID'];
                    $order_id = $_GET['orderID'];
                    $user_id = $_GET['userID'];
                   

                    $sql1 = "UPDATE SLIP_OF_PAYMENT SET is_check='1' WHERE slip_id='$slip_id'";
                    $res1 = mysqli_query($db_con, $sql1) or die("Error in query: $sql1 " . mysqli_error($db_con));

                    $sql = "INSERT INTO CONFIRM_SLIP (slip_id) VALUES ('$slip_id')";
                    $res = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));

                    
                    if ($res && createQRcode($slip_id, $order_id, $user_id) && updateOrderStatus($order_id))
                    {
                        header("Location: prove.php?InsertQRCODEToDBandUpdateOrderStatusSuccess.");
                    }
                
                }
            } elseif ($status == 'ConfirmDeny') {
                $slip_id = $_GET['slipID'];
                $order_id = $_GET['orderID'];

                $sql1 = "UPDATE SLIP_OF_PAYMENT SET is_check='1' WHERE slip_id='$slip_id'";
                $result = mysqli_query($db_con, $sql1) or die("Error in query: $sql1 " . mysqli_error($db_con));

                $sql2 = "UPDATE ORDERS SET status='Fail' WHERE order_id='$order_id';";
                $result2 = mysqli_query($db_con, $sql2) or die("Error in query: $sql2 " . mysqli_error($db_con));

                if ($result && $result2) {
                    header("Location: prove.php?DenySuccess.");
                }
            }
    
        ?>

    </div>


    <!-- INSERT PICTURE -->
    <!-- <div class="contaienr">
        
        <form action="prove.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="pic" require accept="image/*">
            <input type="submit" value="Upload" name="submit">
        </form>
    </div> -->

    <?php
    // if (isset($_POST['submit']))
    // {
    //     $upload = $_FILES['pic']['name'];

    //     if($upload != "")
    //     {
    //         // File contain pictures
    //         $path = "images/";

    //         // Cut file name
    //         $type = strrchr($_FILES['pic']['name'], '.');

    //         // Set date
    //         date_default_timezone_set('Asia/Bangkok');
    //         $date = date("Ymd");

    //         $numrand = (mt_rand());
    //         // Set New name picture
    //         $newName =  $date . $numrand . $type;
    //         $pathCopy = $path . $newName;
    //         $pathLink = 'images/' . $newName;

    //         // move file to File contain pictures
    //         move_uploaded_file($_FILES['pic']['tmp_name'], $pathCopy);

    //         // Insert to db
    //         $sql = "INSERT INTO SLIP_OF_PAYMENT (picture, time_stamp, order_id)
    //                 VALUES ('$newName', '$date', '1')";

    //         $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));

    //         mysqli_close($db_con);
    //     }
    // }
    ?>


</body>
<footer class="text-center text-lg-start text-light" style="background-color: #395902;">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>

                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                    molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                    voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

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
        © 2020 Copyright:
        <a class="text-light" href="#!">คนพันธุ์เสือ</a>
    </div>
    <!-- Copyright -->
</footer>

</html>