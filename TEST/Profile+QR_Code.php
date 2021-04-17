<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile+QR_Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
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
    <nav class="navbar navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/20210413885810631.jpg" alt="" width=" 30" height="24" class="d-inline-block align-text-top">
                ZOO
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row mb-3">
            <?php
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
                }
            }
            // แสดงข้อมูล Profile
            echo "<div class='row mb-3 mt-4'>";
            echo "<h2 class='text-center'>Profile</h2>";
            echo "<br>";
            echo "</div>";
            echo "<div class='col-sm'>";
            echo "<td>" . "<img src='user_images/$user_image' width='200px' height='200px' alt=''>" . "</td>";
            echo "</div>";
            echo "<div class='col-sm'>";
            echo "<h5 class='mb-3' style='line-height: 50px'>First Name: $fname </h5>";
            echo "<h5 class='mb-3' style='line-height: 50px'>Last Name: $lname </h5>";
            echo "<h5 class='mb-3' style='line-height: 50px'>Telephone Number: $tel</h5>";
            echo "</div>";
            echo "<div class='col-sm' >";
            echo "<h5 class='mb-3' style='line-height: 50px'>E-mail: $mail</h5>";
            echo "<h5 class='mb-3' style='line-height: 50px'>Gender: $gender</h5>";
            echo "<h5 class='mb-3' style='line-height: 50px'>Year of Birth:$year</h5>";
            echo "</div>";
            ?>

        </div>
        <br>
        <div class="row mt-4">
            <?php
            // Query ข้อมูลการ Orders
            echo "<h2 class='text-center'>History & QR Code</h2>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col' class='text-center'>QR Code</th>";
            echo "<th scope='col' class='text-center'>Detail</th>";
            echo "<th scope='col' class='text-center'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // ดึงข้อมูลรายละเอียดเกี่ยวกับ Order
            $sql2 = "SELECT * FROM USER RIGHT JOIN ORDERS ON USER.user_id = ORDERS.user_id WHERE USER.user_id = '8';";
            $result = mysqli_query($db_con, $sql2);
            $check_row = mysqli_num_rows($result);

            if ($check_row > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $booking_date = $row['booking_date'];
                    $total_quantity = $row['total_quantity'];
                    $total_price = $row['total_price'];
                    $status = $row['status'];

                    $sql3 = "SELECT * FROM SLIP_OF_PAYMENT, CONFIRM_SLIP, QR_CODE WHERE SLIP_OF_PAYMENT.order_id = $order_id AND SLIP_OF_PAYMENT.slip_id = CONFIRM_SLIP.slip_id AND CONFIRM_SLIP.confirm_id = QR_CODE.confirm_id;";
                    $result = mysqli_query($db_con, $sql3);
                    $check_row = mysqli_num_rows($result);
                    if ($check_row > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $qr_code = $row['qr_code'];
                        }
                    }
                    // แสดงข้อมูลประวัติ QR Code
                    echo "<tr>";
                    echo "<div class='row'>";
                    echo "<div class='col-sm'>";
                    if ($status == "Not_payment_yet") {
                        echo "<td class='text-center' style='vertical-align: middle;'>กรุณาอัพโหลดหลักฐานการชำระเงิน</td>";
                    } elseif ($status == "In_progress") {
                        echo "<td class='text-info text-center' style='vertical-align: middle;'>รายการของท่านอยู่ในระหว่างการตรวจสอบ</td>";
                    } elseif ($status == "Complete") {
                        echo "<td class='text-center' style='vertical-align: middle;'>";
                        echo "<img src='qrcodes/$qr_code' width='150px' height='150px' alt=''>";
                        echo "</td>";
                    } else {
                        echo "<td class='text-danger text-center' style='vertical-align: middle;'>รายการของท่านถูกยกเลิกการตรวจสอบ <br>เนื่องจากพบปัญหา</td>";
                    }
                    echo "</div>";
                    echo "<div class='col-sm'>";
                    echo "<td style='vertical-align: middle;'>";
                    echo "Order ID: $order_id<br>";
                    echo "Booking_date: $booking_date<br>";
                    echo "Total Quantity: $total_quantity<br>";
                    echo "Total Price: $total_price<br>";
                    echo "Status: $status";
                    echo "</td>";
                    echo "</div>";
                    echo "<div class='col-sm'>";

                    if ($status == "Not_payment_yet") {
                        echo "<td class='text-center' style='vertical-align: middle;'>";
                        echo "<button type='button' class='btn btn-warning'>Upload Payment</button>";
                        echo "</td>";
                    } elseif ($status == "In_progress") {
                        echo "<td class='text-info text-center' style='vertical-align: middle;'>อยู่ระหว่างการตรวจสอบ</td>";
                    } elseif ($status == "Complete") {
                        echo "<td class='text-center' style='vertical-align: middle;'>";
                        // Button trigger modal
                        echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#QR_Modal'>View QR Code</button>";
                        echo "</td>";
                    } else {
                        echo "<td class='text-danger text-center' style='vertical-align: middle;'>ยกเลิกการตรวจสอบ</td>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='3' style='text-align:center;' mb-3>ไม่พบประวัติการสั่งซื้อ QR Code</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            ?>
        </div>
    </div>
    <!-- QR Modal -->
    <div class="modal fade" id="QR_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src='qrcodes/$qr_code' width='150px' height='150px' alt=''>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>