<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        ob_start();
        include('dbserver.php');
        require('function.php');
    ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Account Summary</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        /* body {
            background-image: url('https://images.pexels.com/photos/33045/lion-wild-africa-african.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
        } */
    </style>
</head>

<body>
    <div class="container py-5">
        <?php

            date_default_timezone_set('Asia/Bangkok');
            $date = date("Y-m-d");
            // echo $date;
            if(isset($_GET['month']) && isset($_GET['date']))
            {
                $date = "2021-" . $_GET['month'] . "-" . $_GET['date'];

              
            }
             $sql= "SELECT SUM(total_quantity) AS totalQuantity, SUM(total_price_and_vat) AS totalPrice, booking_date FROM ORDERS GROUP BY booking_date HAVING booking_date LIKE '$date';";
             $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
             $row = mysqli_fetch_assoc($result);
             $check_row1 = mysqli_num_rows($result);

             if ($check_row1 != 0)
             {
                $booking_date = $row['booking_date'];
                $totalQuantity = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
             }
             else
             {
                $booking_date = $date;
                $totalQuantity = 0;
                $totalPrice = 0;
             }
             
        ?>
        
        <form action="summary_back.php" method="GET">
        <div class="row">

            <div class="col-sm-8">
                <h1>Daily Account Summary</h1>
                <?php echo "<h5>Date: " . "<span class='text-success'>" . $booking_date . "</span></h5>"; ?>
            </div>
            
           
                <div class="col-sm-1">
                    <p class="text-center">Year</p>
                    <div class="input-group mb-3">
                        <input name="year" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="2021" disabled>
                    </div>

                </div>

                <div class="col-sm-1">
                    
                    <p class="text-center">Month</p>
                    <select class="form-select" aria-label="Default select example" name="month">
                            <option selected>Select Month</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                </div>
                <div class="col-sm-1">
                    
                    <p class="text-center">Date</p>
                
                        <select class="form-select" aria-label="Default select example" name="date">
                            <option selected>Select Date</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                </div>

                <div class="col-sm-1">
                <br>
                    <button name="changeBtn" type="submit" class="btn btn-success mt-3">Change</button>
                </div>
            

        </div>
        </form>
        <hr>

        <div class="row text-center"> 
            <div class="col-md-4">
                <h6>Number of bookings per day</h6>
                <?php echo "<h2>" . $totalQuantity . "</h2>"; ?>
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <h6>booking income</h6>
                <h2><?php echo $totalPrice; ?></h2>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-12">
                <form action="Summary_back.php" method="POST">
                    <div class="card">
                        <div class="row mx-3 mt-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5>Today's customer booking list</h5>
                                    </div>
                                    <div class="col-md-2">
                                        
                                    </div>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-50" scope="col">Type card</th>
                                            <th class="w-25 text-center" scope="col">Number of people</th>
                                            <th class="w-25 text-center" scope="col">Booking price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT T.ticket_id, SUM(OT.quantity) AS countType, T.type, O.booking_date, T.price
                                                    FROM ORDERS AS O
                                                    INNER JOIN ORDER_TICKET AS OT
                                                    USING (order_id)
                                                    INNER JOIN TICKET AS T
                                                    USING (ticket_id)
                                                    GROUP BY T.ticket_id, O.booking_date
                                                    HAVING O.booking_date LIKE '$date'
                                                    ORDER BY T.ticket_id, O.booking_date
                                            ";

                                            $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
                                            $check_row = mysqli_num_rows($result);
                                            $i = 1;
                                            if ($check_row > 0) 
                                            {
                                                while ($row = mysqli_fetch_assoc($result)) 
                                                {
                                                    
                                        
                                                    if ($i == 1)
                                                    {
                                                        echo "<tr>";
                                                            echo '<th scope="row">Thai Kid</th>';
                                                            echo '<td class="text-center">' . $row['countType'] . '</td>';
                                                            echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 .'</td>';
                                                        echo "</tr>";
                                                        $i ++;
                                                    }
                                                    else if ($i == 2)
                                                    {   echo "<tr>";
                                                            echo '<th scope="row">Thai Adult</th>';
                                                            echo '<td class="text-center">' . $row['countType'] . '</td>';
                                                            echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 .'</td>';
                                                        echo "</tr>";
                                                            $i ++;
                                                    }
                                                    else if ($i == 3)
                                                    {
                                                        echo "<tr>";
                                                            echo '<th scope="row">Foreigner Kid</th>';
                                                            echo '<td class="text-center">' . $row['countType'] . '</td>';
                                                            echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 .'</td>';
                                                            $i ++;
                                                        echo "</tr>";
                                                    }
                                                    else if ($i == 4)
                                                    {
                                                        echo "<tr>";
                                                            echo '<th scope="row">Foreigner Adult</th>';
                                                            echo '<td class="text-center">' . $row['countType'] . '</td>';
                                                            echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 .'</td>';
                                                        echo "</tr>";
                                                        $i = 1 ;
                                                    }
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- <h6 class="pl-2 pb-2">Number of Search Results : 998</h6> -->
                                <div class="row pb-3">
                                    <button type="submit" class="btn btn-success ">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>