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
    echo "<div style='text-align: center;'>";
    echo "<h2>Profile</h2>";
    echo "<h4>First Name: $fname </h4>";
    echo "<h4>Last Name: $lname </h4>";
    echo "<h4>Telephone Number: $tel</h4>";
    echo "<h4>E-mail: $mail</h4>";
    echo "<h4>Gender: $gender</h4>";
    echo "<h4>Year of Birth:$year</h4>";
    echo "<br>";

    // Query ข้อมูลการ Orders
    echo "<h2>History & QR Code</h2>";
    $sql2 = "SELECT * FROM USER RIGHT JOIN ORDERS ON USER.user_id = ORDERS.user_id WHERE USER.user_id = '$id';";
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
            echo "<h4>Order ID: $order_id</h4>";
            echo "<h4>Booking_date: $booking_date</h4>";
            echo "<h4>Total Quantity: $total_quantity</h4>";
            echo "<h4>Total Price: $total_price</h4>";
            echo "<h4>Status: $status</h4>";
            echo "<br>";
        }
    }
    ?>
</body>

</html>