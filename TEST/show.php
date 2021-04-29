<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    // session_start();
    date_default_timezone_set('Asia/Bangkok');
    // $date = date("Y-m-d");
    $date = '2021-04-29';

    // FIND latest confirm_id
    $sql = "SELECT SP.time_stamp AS Upload_date, O.booking_date AS Booking_date, O.status AS status, SP.slip_id AS slip_id, O.order_id AS order_id
            FROM SLIP_OF_PAYMENT AS SP
            RIGHT JOIN ORDERS AS O
            USING (order_id) 
            WHERE SP.time_stamp >= O.booking_date OR (SP.time_stamp IS NULL AND O.booking_date = '$date')
            ";

            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
            $check_row = mysqli_num_rows($result);
            
            if ($check_row > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    // $summary_id = $row['summary_id'];
                    // $confirm_id = $row['confirm_id'];
                    // $date_booking = $row['date_booking'];
                    // $income = $row['income'];
                    // $all_ticket = $row['count_of_sale_ticket'];
                    // $th_kid = $row['count_thai_kid_ticket'];
                    // $th_adult = $row['count_thai_adult_ticket'];
                    // $fr_kid = $row['count_foreigner_kid_ticket'];
                    // $fr_adult = $row['count_foreigner_adult_ticket'];

                    // echo "summary_id: " . $row['summary_id'] . "<br>";
                    // echo "confirm_id" . $row['confirm_id'] . "<br>";
                    // echo "date_booking" . $row['date_booking'] . "<br>";
                    echo "order_id: " . $row['order_id'] . "<br>";
                    echo "slip_id: " . $row['slip_id'] . "<br>";
                    echo "Upload_date: " . $row['Upload_date'] . "<br>";
                    echo "Booking_date: " . $row['Booking_date'] . "<br>";
                    echo "status: " . $row['status'] . "<br>";
                    echo "<br><br><br>";
                }
            }
    
    
    // $i = 1;
    // if ($check_row > 0) 
    // {
    //     while ($row = mysqli_fetch_assoc($result)) 
    //     {
            
    //         echo "Date: " . $row["booking_date"] . "<br/>";
    //         if ($i == 1)
    //         {
                
    //             echo "TH KID: " . $row["countType"] . "<br/>";
    //             echo "Price: " . $row["price"] . "<br/>";
    //             $i ++;
    //         }
    //         else if ($i == 2)
    //         {
    //             echo "TH ADULT: " . $row["countType"] . "<br/>";
    //             echo "Price: " . $row["price"] . "<br/>";
    //             $i ++;
    //         }
    //         else if ($i == 3)
    //         {
    //             echo "FR KID: " . $row["countType"] . "<br/>";
    //             echo "Price: " . $row["price"] . "<br/>";
    //             $i ++;
    //         }
    //         else if ($i == 4)
    //         {
    //             echo "FR ADULT: " . $row["countType"] . "<br/>";
    //             echo "Price: " . $row["price"] . "<br/>";
    //             $i = 1 ;
    //         }
    //     }
    // }
    // else {echo '0 rows';}
 // GET ORDER DETAILS DATA WHEN APPROVE 
    ?>
</body>
</html>