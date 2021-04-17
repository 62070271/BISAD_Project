<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile+QR_Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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
                <img src="images\20210413885810631.jpg" alt="" width=" 30" height="24" class="d-inline-block align-text-top">
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
                }
            }
            // แสดงข้อมูล Profile
            echo "<div class='row mb-3'>";
            echo "<h2 class='text-center'>Profile</h2>";
            echo "<br>";
            echo "</div>";
            echo "<div class='col-sm'>";
            echo "<td>" . "<img src='\images\20210413885810631.jpg' width='200px' height='200px' alt=''>" . "</td>";
            echo "</div>";
            echo "<div class='col-sm'>";
            echo "<h4 class='mb-3'>First Name: $fname </h4>";
            echo "<h4 class='mb-3'>Last Name: $lname </h4>";
            echo "<h4 class='mb-3'>Telephone Number: $tel</h4>";
            echo "</div>";
            echo "<div class='col-sm'>";
            echo "<h4 class='mb-3'>E-mail: $mail</h4>";
            echo "<h4 class='mb-3'>Gender: $gender</h4>";
            echo "<h4 class='mb-3'>Year of Birth:$year</h4>";
            echo "</div>";
            ?>

        </div>
        <br>
        <div class="row">
            <?php
            // Query ข้อมูลการ Orders
            echo "<h2 class='text-center'>History & QR Code</h2>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>QR Code</th>";
            echo "<th scope='col'>Detail</th>";
            echo "<th scope='col'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $sql2 = "SELECT * FROM USER RIGHT JOIN ORDERS ON USER.user_id = ORDERS.user_id WHERE USER.user_id = '3';";
            $result = mysqli_query($db_con, $sql2);
            $check_row = mysqli_num_rows($result);

            if ($check_row > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $booking_date = $row['booking_date'];
                    $total_quantity = $row['total_quantity'];
                    $total_price = $row['total_price'];
                    $status = $row['status'];
                    // แสดงข้อมูล QR+Code
                    echo "<tr>";
                    echo "<div class='row'>";
                    echo "<div class='col-sm'>";
                    echo "<td>";
                    echo "<img src='images\20210413885810631.jpg' width='200px' height='200px' alt=''>";
                    echo "</td>";
                    echo "</div>";
                    echo "<div class='col-sm'>";
                    echo "<td>";
                    echo "Order ID: $order_id<br>";
                    echo "Booking_date: $booking_date<br>";
                    echo "Total Quantity: $total_quantity<br>";
                    echo "Total Price: $total_price<br>";
                    echo "Status: $status";
                    echo "</td>";
                    echo "</div>";
                    echo "<div class='col-sm'>";

                        if($status == "Not_payment_yet"){
                            echo "<td>";
                            echo "<button type='button' class='btn btn-warning'>Upload Payment</button>";
                            echo "</td>";
                        }
                        elseif($status == "In_progress"){
                            echo "<td class='text-info'>อยู่ระหว่างการตรวจสอบ</td>";
                        }
                        elseif($status == "Complete"){
                            echo "<td>";
                            echo "<button type='button' class='btn btn-primary'>View QR Code</button>";
                            echo "</td>";
                        }
                        else{
                            echo "<td class='text-danger'>ยกเลิกการตรวจสอบ</td>";
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
</body>

</html>