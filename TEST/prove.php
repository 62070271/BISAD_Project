<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php
        include('dbserver.php');

        $sql = "SELECT * 
                FROM SLIP_OF_PAYMENT AS S
                INNER JOIN ORDERS AS O
                ON S.order_id = O.order_id
                INNER JOIN USER AS U
                ON O.user_id = U.user_id;";

        $result = mysqli_query($db_con, $sql) or die ("Error in query: $sql " . mysqli_error($db_con));
        $check_row = mysqli_num_rows($result);

       
    ?>
    <title>Prove Statement</title>
</head>
<body>

    <div class="container mt-5 ml-5 mr-5 table-responsive">

        <h2 class="text-center mb-3">Prove Statement</h2>
        
        <table class="table table-bordered">

            <thead class="text-center">
                <tr>
                    <th scope="col" style="width: 10%;">Order ID</th>
                    <th scope="col" style="width: 10%;">Customer ID</th>
                    <th scope="col">Total price (vat 7 %)</th>
                    <th scope="col" style="width: 15%;">Booking Date</th>
                    <th scope="col" style="width: 15%;">Slip TimeStamp</th>
                    <th scope="col">Slip of Payment</th>
                    <th scope="col">Confirm</th>
                    <th scope="col">Deny</th>
                </tr>
            </thead>

            <tbody class="text-center">
                <form action="prove.php" method="post">
                    <?php
                        if ($check_row > 0) 
                        {
                            while ($row = mysqli_fetch_assoc($result)) 
                            {

                                echo "<tr>";

                                        echo "<p name='" . $row['slip_id'] . "'  value='" . $row['slip_id'] . "'></p>";
                                        echo "<th name='" . $row['order_id'] . "' value ='" . $row['order_id'] . "' scope='row' style='padding-top:75px;'>" . $row['order_id'] . "</th>";
                                        echo "<th scope='row' style='padding-top:75px;'>" . $row['user_id'] . "</th>";
                                        echo "<td style='padding-top:75px;'>" . $row['total_price_and_vat'] . "</td>";
                                        echo "<td style='padding-top:75px;'>" . $row['booking_date'] . "</td>";
                                        echo "<td style='padding-top:75px;'>" . $row['time_stamp'] . "</td>";
                                        echo "<td>" . "<img src='images/" . $row['picture'] . "' width='200px' height='200px' alt=''>" . "</td>";
                                        echo "<td style='padding-top:75px;'>" . "<a href='prove.php?slipID=" . $row['slip_id'] . "&orderID=" . $row['order_id'] . "&status=confirm'><button type='button' class='btn btn-success'>Confirm</button></a>" . "</td>";
                                        echo "<td style='padding-top:75px;'>" . "<a href='prove.php?slipID=" . $row['slip_id'] . "&orderID=" . $row['order_id'] . "&status=deny'><button type='button' class='btn btn-danger'>Cancel</button></a>" . "</td>";

                                echo "</tr>";
                            }
                        }
                    ?>
                </form>
            </tbody>

        </table>

    </div>

    <?php
        if(isset($_GET['status']) == 'confirm')
        {
            $slip_id = $_GET['slipID'];
            $order_id = $_GET['orderID'];
            echo '<script>alert(' . $slip_id . ')</script>';
        }
    ?>

    <!-- INSERT PICTURE
    <div class="contaienr">
        
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

                mysqli_close($db_con);
        //     }
        // }
        
    ?>
    
</body>
</html>