<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test_UI.php</title>
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Sperate -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <?php
    include('dbserver.php');
    require_once('function.php');

    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: logIn_front.php");
    }
    ?>
</head>

<body>
    <?php
    // ใช้ session จาก Email
    $email = $_SESSION['email'];
    // Query ข้อมูล Profile จาก email 
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
            $user_image = $row['user_image'];
            $name_and_type = $fname . " " . $lname . " " . " (" . $type . ") ";
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/20210413885810631.jpg" alt="" width=" 30" height="30" class="d-inline-block align-text-top border border-white rounded-circle">
                ZOO
            </a>
            <!-- Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo "<img src='user_images/$user_image' alt='' width='30' height='30' class='d-inline-block align-text-top border border-white rounded-circle'>"; ?>&nbsp;<?php echo "$name_and_type"; ?></a>
                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="Profile+QR_Code.php">Profile & QR Code</a></li>
                    <li><a class="dropdown-item" href="Editprofile.php">Edit profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mb-3">
            <!-- แสดงข้อมูล Profile -->
            <div class='row mb-3 mt-4'>
                <h2 class='text-center'>Profile</h2>
                <br>
            </div>
            <div class='col-md-4 col-12 text-center'>
                <td><img src='user_images/<?php echo "$user_image" ?>' class='rounded border border-dark' width='200px' height='200px' alt=''></td>
            </div>
            <div class='col-md-4 col-12'>
                <h5 class='mb-3' style='line-height: 50px'>First Name:<?php echo "$fname" ?></h5>
                <h5 class='mb-3' style='line-height: 50px'>Last Name:<?php echo "$lname" ?></h5>
                <h5 class='mb-3' style='line-height: 50px'>Telephone Number:<?php echo "$tel" ?></h5>
            </div>
            <div class='col-md-4 col-12'>
                <h5 class='mb-3' style='line-height: 50px'>E-mail:<?php echo "$mail" ?></h5>
                <h5 class='mb-3' style='line-height: 50px'>Gender:<?php echo "$gender" ?></h5>
                <h5 class='mb-3' style='line-height: 50px'>Year of Birth:<?php echo "$year" ?></h5>
            </div>
        </div>
        <br>
        <div class="row mt-4">
            <h2 class='text-center'>History & QR Code</h2>
        </div>
        <?php
        // ดึงข้อมูลรายละเอียดเกี่ยวกับ Order
        $sql2 = "SELECT * FROM USER RIGHT JOIN ORDERS ON USER.user_id = ORDERS.user_id WHERE USER.user_id = '$id' ORDER BY ORDERS.order_id DESC;";
        $result = mysqli_query($db_con, $sql2);
        $check_row = mysqli_num_rows($result);
        ?>
        <div class="row">
            <?php
            // แสดงข้อมูล order
            if ($check_row > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $booking_date = $row['booking_date'];
                    $total_quantity = $row['total_quantity'];
                    $total_price = $row['total_price'];
                    $status = $row['status'];
                    // 
                    $sql3 = "SELECT * FROM SLIP_OF_PAYMENT, CONFIRM_SLIP, QR_CODE WHERE SLIP_OF_PAYMENT.order_id = 
                    $order_id AND SLIP_OF_PAYMENT.slip_id = CONFIRM_SLIP.slip_id AND CONFIRM_SLIP.confirm_id = QR_CODE.confirm_id;";
                    $result2 = mysqli_query($db_con, $sql3);
                    $check_row2 = mysqli_num_rows($result2);
                    if ($check_row2 > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $qr_code = $row['qr_code'];
                        }
                    }

            ?>
                    <div class="col-md-4">
                        <div class="card mt-3 mb-3">
                            <div class="row g-0">
                                <div class="col">
                                    <?php if ($status == "Not_payment_yet") { ?>
                                        <span class='text-center' style='vertical-align: middle;'>กรุณาอัพโหลดหลักฐานการชำระเงิน</span>
                                    <?php } elseif ($status == "In_progress") { ?>
                                        <span class='text-info text-center' style='vertical-align: middle;'>รายการของท่านอยู่ในระหว่างการตรวจสอบ</span>
                                    <?php } elseif ($status == "Complete") { ?>
                                        <img src="qrcodes/<?php echo "$qr_code" ?> " width='190px' height='190px'>
                                    <?php } else { ?>
                                        <span class='text-danger text-center' style='vertical-align: middle;'>รายการของท่านถูกยกเลิกการตรวจสอบ <br>เนื่องจากพบปัญหา</span>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <!-- <div class="row">
                                            <div class="col"> -->
                                        <h5 class="card-title">Order ID: <?php echo "$order_id" ?></h5>
                                        <p class="card-text">
                                            Booking date: <?php echo "$booking_date" ?><br>
                                            Status: <?php echo "$status" ?>
                                        </p>
                                        <!-- </div>
                                        </div> -->
                                        <!-- <div class="row">
                                            <div class="col"> -->
                                        <?php if ($status == "Not_payment_yet") { ?>
                                            <button type='button' class='btn btn-warning' href='#uploadslip_front.php'><span style="font-size:smaller;">Upload Payment</span></button>
                                        <?php } elseif ($status == "In_progress") { ?>
                                            <p class='text-info text-center' style='vertical-align: middle;'>อยู่ระหว่างการตรวจสอบ</p>
                                        <?php } elseif ($status == "Complete") { ?>
                                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#QR_Modal'>View QR Code</button>
                                        <?php } elseif ($status == "Fail") { ?>
                                            <span class='text-danger' style='vertical-align: middle;'>ยกเลิกการตรวจสอบ</span>
                                        <?php } ?>
                                        <!-- </div>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>