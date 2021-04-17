<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    </style>
</head>

<body>

    <div class="container my-5 table-responsive">
        <?php
        // $QR = '<img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive">';
        // echo $QR;
        ?>

        <h2 class="text-center mb-3">Prove Statement</h2>

        <table class="table table-bordered table-striped" style="z-index: 1;">

            <thead class="text-center thead-dark">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col" >Customer ID</th>
                    <th scope="col" style="width: 15%;">Total price (vat 7 %)</th>
                    <th scope="col" style="width: 15%;">Booking Date</th>
                    <th scope="col" style="width: 15%;">Slip TimeStamp</th>
                    <th scope="col">Slip of Payment</th>
                    <th scope="col">Confirm</th>
                    <th scope="col">Deny</th>
                </tr>
            </thead>

            <tbody class="text-center">
                <?php
                if ($check_row > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";

                        echo "<p value='" . $row['slip_id'] . "'></p>";
                        echo "<th name='" . $row['order_id'] . "' value ='" . $row['order_id'] . "' scope='row' style='padding-top:75px;'>" . $row['order_id'] . "</th>";
                        echo "<th scope='row' style='padding-top:75px;'>" . $row['user_id'] . "</th>";
                        echo "<td style='padding-top:75px;'>" . $row['total_price_and_vat'] . "</td>";
                        echo "<td style='padding-top:75px;'>" . $row['booking_date'] . "</td>";
                        echo "<td style='padding-top:75px;'>" . $row['time_stamp'] . "</td>";
                        echo "<td>" . "<img src='images/" . $row['picture'] . "' width='200px' height='200px' alt='' class='slip'>" . "</td>";
                        echo "<td style='padding-top:75px;'>" . "<a href='' id='x" . $row['slip_id'] . "' class='header btn btn-success btn-lg' onclick='return x(" .  $row['slip_id'] . "," . $row['order_id'] . "," .  $row['user_id']  . ")'>Confirm</a>" . "</td>";
                        echo "<td style='padding-top:75px;'>" . "<a href='' id='y" . $row['slip_id'] . "' class='header btn btn-danger btn-lg' onclick='return y(" .  $row['slip_id'] . "," . $row['order_id'] . "," .  $row['user_id']  . ")'>Cancel</a>" . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>

        </table>
        <script>
            function x(slip_id, order_id, user_id) 
            {
                if (confirm("Do want to confirm this\nOrder ID: " + order_id + "\nSlip ID: " + slip_id)) {
                    document.getElementById('x' + slip_id).href ='prove.php?orderID='+order_id+'&slipID='+slip_id+'&userID='+user_id+'&status=Confirm';
                }
                else {
                    document.getElementById('x' + slip_id).href ='prove.php?orderID='+order_id+'&slipID='+slip_id+'&userID='+user_id+'&status=CancelConfirm';
                    alert ('CancelConfirm!');
                }
            }

            function y(slip_id, order_id)
            {
                if (confirm("Do want to Confirm Deny this\nOrder ID: " + order_id + "\nSlip ID: " + slip_id)) {
                    document.getElementById('y' + slip_id).href ='prove.php?orderID='+order_id+'&slipID='+slip_id+'&status=ConfirmDeny';
                }
                else {
                    document.getElementById('y' + slip_id).href ='prove.php?CancelDeny';
                    alert ('CancelDeny');
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

                elseif ($status == 'ConfirmDeny')
                {
                    $slip_id = $_GET['slipID'];
                    $order_id = $_GET['orderID'];

                    $sql1 = "UPDATE SLIP_OF_PAYMENT SET is_check='1' WHERE slip_id='$slip_id'";
                    $result = mysqli_query($db_con, $sql1) or die("Error in query: $sql1 " . mysqli_error($db_con));
                    
                    $sql2 = "UPDATE ORDERS SET status='Fail' WHERE order_id='$order_id';";
                    $result2 = mysqli_query($db_con, $sql2) or die("Error in query: $sql2 " . mysqli_error($db_con));
                    
                    if ($result && $result2)
                    {
                        header("Location: prove.php?DenySuccess.");
                    }
                  
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
    //         $path = "images/";

    //         $type = strrchr($_FILES['pic']['name'], '.');

    //         date_default_timezone_set('Asia/Bangkok');
    //         $date = date("Ymd");

    //         $numrand = (mt_rand());
    //         $newName =  $date . $numrand . $type;
    //         $pathCopy = $path . $newName;
    //         $pathLink = 'images/' . $newName;

    //         move_uploaded_file($_FILES['pic']['tmp_name'], $pathCopy);

    //         $sql = "INSERT INTO SLIP_OF_PAYMENT (picture, time_stamp, order_id)
    //                 VALUES ('$newName', '$date', '1')";

    //         $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));

    //         mysqli_close($db_con);
    //     }
    // }

    ?>


</body>

</html>