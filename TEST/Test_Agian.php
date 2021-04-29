<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
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
    <style>
        .w-33 {
            width: 33%;
        }
    </style>
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
        }
    }
    // ดึงข้อมูลรายละเอียดเกี่ยวกับ Order
    $sql2 = "SELECT * FROM USER RIGHT JOIN ORDERS ON USER.user_id = ORDERS.user_id WHERE USER.user_id = '$id' ORDER BY ORDERS.order_id DESC;";
    $result = mysqli_query($db_con, $sql2);
    $check_row = mysqli_num_rows($result);
    // แสดงข้อมูล order
    if ($check_row > 0) {
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $order_id = $row['order_id'];
            $booking_date = $row['booking_date'];
            $total_quantity = $row['total_quantity'];
            $total_price_and_vat = $row['total_price_and_vat'];
            $status = $row['status'];
            if ($status == "Unpaid") { ?>
                <!-- <script>
                    function x(slip_id, order_id, user_id) {
                        if (confirm("Do want to confirm this\nOrder ID: " + order_id + "\nSlip ID: " + slip_id)) {
                            document.getElementById('x' + slip_id).href = 'prove.php?orderID=' + order_id + '&slipID=' + slip_id + '&userID=' + user_id + '&status=Confirm';
                        } else {
                            document.getElementById('x' + slip_id).href = 'prove.php?orderID=' + order_id + '&slipID=' + slip_id + '&userID=' + user_id + '&status=CancelConfirm';
                            alert('CancelConfirm!');
                        }
                    }
                </script> -->
                <!-- <form style="display: iline;" action="uploadslip_back.php" method="POST" value="" onsubmit="return validateForm()">
                    <a type='submit' class='btn btn-warning' href='uploadslip_front.php'>
                        <span style="font-size:smaller;">Upload Payment</span>
                    </a> -->
                <!-- ปุ่มแสดง Modal -->
                <?php
                date_default_timezone_set('asia/bangkok');
                echo date('ํY-m-d h:i:s');
                ?><br>
                <?php echo $order_id ?><br>
                <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#QR_Modal_<?= $order_id ?>'>Purchase</button><br>
                <!-- QR Modal -->
                <div class="modal fade" id="QR_Modal_<?= $order_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title " id="exampleModalLabel">Order ID: <?php echo $order_id ?></h5><br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4 class="text-center">Confirm Purchase</h4>
                                <div class="text-center">
                                    <img class=" mb-2" src='qrcodes/<?php echo $qr_code ?>' width='250px' height='250px' alt=''>
                                </div>
                                <h6 class="text-center">ธนาคาร: xxxxxxxx</h6>
                                <h6 class="text-center">เลขที่บัญชี: xxx-xxxxxx-x</h6>
                                <h6 class="text-center">สวนสัตว์คนพันธุ์เสือ</h6>
                                <div class='modal-body'>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="w-33 text-center" scope="col">Ticket</th>
                                                    <th class="w-33 text-center" scope="col">Quantity</th>
                                                    <th class="w-33 text-center" scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $q_ticket = "SELECT * FROM ORDER_TICKET JOIN TICKET ON ORDER_TICKET.ticket_id = TICKET.ticket_id WHERE ORDER_TICKET.order_id = '$order_id';";
                                                $ticket_detail = mysqli_query($db_con, $q_ticket);
                                                $check_row_ticket = mysqli_num_rows($ticket_detail);
                                                while ($row = mysqli_fetch_assoc($ticket_detail)) {
                                                    $ticket_type = $row['type'];
                                                    $ticket_quantity = $row['quantity'];
                                                    $ticket_quantity_price = $row['quantity'] * $row['price'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo "$ticket_type" ?></td>
                                                        <td class="text-center"><?php echo "$ticket_quantity" ?> </td>
                                                        <td class="text-center"><?php echo "$ticket_quantity_price" ?> </td>

                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <th style="font-size:small;">Total price+vat 7%</th>
                                                <th class="text-center"><?php echo $total_quantity ?></th>
                                                <th class="text-center"><?php echo $total_price_and_vat ?></th>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <span class="d-flex justify-content-end mb-8"><b>Booking date: </b>&nbsp;<?php echo $booking_date ?></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger">Cancle Payment</button>
                                <button type="button" class="btn btn-primary">Upload Payment</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </form> -->
    <?php }
        }
    } ?>
</body>

</html>