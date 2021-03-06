<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    ob_start();
    session_start();
    include('dbserver.php');
    require('function.php');
    ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icon -->
    <link rel="shortcut icon" type="image/x-icon" class="rounded-circle" href="Web_Image/Logo_Web.ico" />
    <title>Daily Account Summary</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main_css.css">
    <!-- Font Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!-- Font Rammetto -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
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
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    if (isset($_SESSION['email'])) {
        if ($_SESSION['user_type'] == 'Customer') {
            header("Location: index.php?status=loggedIn.php");
        }
        if ($_SESSION['user_type'] == 'Reception') {
            header("Location: scanner.php?status=loggedIn.php");
        }
        $user_name = $_SESSION['user_name'];
        $user_image = $_SESSION['user_image'];
    }
    ?>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #395902;">
            <div class="container">
                <a class="navbar-brand" href="index.php?status=loggedIn">
                    <img src="Web_Image/Logo300X300v4.png" alt="" width=" 32" height="32" class="d-inline-block align-text-top rounded-circle">
                    <span class="rammeto">ZOO</span>
                </a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item" class="navbar-nav me-auto mb-2 mb-lg-0">
                            <a id='nav-link1' class="nav-link shadow-sm text-white" class='shadow-lg  align-text-top' href="prove.php?status=loggedIn"><b>Prove</b><span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item text-white">
                            <a id='nav-link2' class="nav-link shadow-sm text-white" class='align-text-top' href="summary_front.php?status=loggedIn"><b>Summary</b><span class="sr-only"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FBB03B;">
                        <img src='user_images/<?php echo $_SESSION["user_image"] ?>' alt='' width='25' height='25' class='d-inline-block align-text-top rounded-circle'>&nbsp<?php echo $_SESSION['user_name'] . ' '; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?logout=1">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d");
    $current_year = date("Y");

    // echo $date;
    if (isset($_GET['month']) && isset($_GET['date'])) {
        $date = $current_year . "-" . $_GET['month'] . "-" . $_GET['date'];
    }

    $sql = "SELECT date_booking, SUM(income) AS income, SUM(count_of_sale_ticket) AS t_ticket, SUM(count_thai_kid_ticket) AS t_thkid, SUM(count_thai_adult_ticket) AS t_thad, SUM(count_foreigner_kid_ticket) AS t_frkid, SUM(count_foreigner_adult_ticket) AS t_frad
            FROM SUMMARY_ACCOUNT AS SA
            GROUP BY date_booking
            HAVING date_booking LIKE '$date'
            ";
    $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
    $row = mysqli_fetch_assoc($result);
    $check_row1 = mysqli_num_rows($result);

    if ($check_row1 != 0) {
        $booking_date = $row['date_booking'];
        $totalQuantity = $row['t_ticket'];
        $totalPrice = $row['income'];
    } else {
        $booking_date = $date;
        $totalQuantity = 0;
        $totalPrice = 0;
    }
    // if (isset($_GET['logout'])) {
    //     unset($_SESSION['email']);
    //     header("Location: logIn_front.php");
    // }
    ?>
    <div class="container py-5 my-3">
        <form action="summary_back.php" method="GET">
            <div class="row">

                <div class="col-sm-8">
                    <h1 class="rammeto ptyellow">Daily Account Summary</h1>
                    <?php echo "<h5 class='rammeto'>Date: " . "<span class='text-success'>" . $booking_date . "</span></h5>"; ?>
                </div>


                <div class="col-sm-1">
                    <p class="text-center rammeto">Year</p>
                    <div class="input-group mb-3">
                        <input name="year" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $current_year ?>" disabled>
                    </div>

                </div>

                <div class="col-sm-1">

                    <p class="text-center rammeto">Month</p>
                    <select class="form-select" aria-label="Default select example" name="month">
                        <option selected><?php if (isset($_GET['month'])) {
                                                echo $_GET['month'];
                                            } else {
                                                echo 'Select month';
                                            } ?></option>
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

                    <p class="text-center rammeto">Date</p>

                    <select class="form-select" aria-label="Default select example" name="date">
                        <option selected><?php if (isset($_GET['date'])) {
                                                echo $_GET['date'];
                                            } else {
                                                echo 'Select Date';
                                            } ?></option>
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
                    <button name="changeBtn" type="submit" class="btn btn-success mt-3 rammeto">Change</button>
                </div>


            </div>
        </form>
        <hr>

        <div class="row text-center">
            <div class="col-md-4">
                <h6 class="rammeto ptlightgreen">Number of bookings per day</h6>
                <h2 class="ptyellow"><?php echo $totalQuantity; ?></h2>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <h6 class="rammeto ptlightgreen">booking income</h6>
                <h2 class="ptyellow"><?php echo $totalPrice; ?></h2>
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
                                        <h5 class="rammeto ptlightgreen">Customer booking list</h5>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr class="bglightgreen kanit text-white">
                                            <th class="w-50 " scope="col">Ticket type</th>
                                            <th class="w-25 text-center " scope="col">Number of people</th>
                                            <th class="w-25 text-center " scope="col">Booking price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- SHOW SUMMARY DATA BY DATE -->
                                        <?php
                                        $sql = "SELECT SUM(income) AS income, SUM(count_of_sale_ticket) AS t_ticket, SUM(count_thai_kid_ticket) AS t_thkid, SUM(count_thai_adult_ticket) AS t_thad, SUM(count_foreigner_kid_ticket) AS t_frkid, SUM(count_foreigner_adult_ticket) AS t_frad
                                                FROM SUMMARY_ACCOUNT AS SA
                                                GROUP BY date_booking
                                                HAVING date_booking LIKE '$date'
                                                ";

                                        $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
                                        $check_row = mysqli_num_rows($result);

                                        if ($check_row > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo '<th scope="row" class="kanit">Thai Kid</th>';
                                                echo '<td class="text-center">' . $row['t_thkid'] . '</td>';
                                                echo '<td class="text-center">' . $row['t_thkid'] * 30 * 1.07 . '</td>';
                                                echo "</tr>";

                                                echo "<tr>";
                                                echo '<th scope="row" class="kanit">Thai Adult</th>';
                                                echo '<td class="text-center">' . $row['t_thad'] . '</td>';
                                                echo '<td class="text-center">' . $row['t_thad'] * 150 * 1.07 . '</td>';
                                                echo "</tr>";

                                                echo "<tr>";
                                                echo '<th scope="row" class="kanit">Foreigner Kid</th>';
                                                echo '<td class="text-center">' . $row['t_frkid'] . '</td>';
                                                echo '<td class="text-center">' . $row['t_frkid'] * 150 * 1.07 . '</td>';
                                                echo "</tr>";

                                                echo "<tr>";
                                                echo '<th scope="row" class="kanit">Foreigner Adult</th>';
                                                echo '<td class="text-center">' . $row['t_frad'] . '</td>';
                                                echo '<td class="text-center">' . $row['t_frad'] * 250 * 1.07 . '</td>';
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr>";
                                            echo '<th scope="row" class="kanit">Thai Kid</th>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo '<th scope="row" class="kanit">Thai Adult</th>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo '<th scope="row" class="kanit">Foreigner Kid</th>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo '<th scope="row" class="kanit">Foreigner Adult</th>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo '<td class="text-center">' . 0 . '</td>';
                                            echo "</tr>";
                                        }
                                        // $i = 1;
                                        // if ($check_row > 0) {
                                        //     while ($row = mysqli_fetch_assoc($result)) {


                                        //         if ($i == 1) {
                                        //             echo "<tr>";
                                        //             echo '<th scope="row" class="kanit">??????????????????????????????</th>';
                                        //             echo '<td class="text-center">' . $row['countType'] . '</td>';
                                        //             echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 . '</td>';
                                        //             echo "</tr>";
                                        //             $i++;
                                        //         } else if ($i == 2) {
                                        //             echo "<tr>";
                                        //             echo '<th scope="row" class="kanit">???????????????????????????????????????</th>';
                                        //             echo '<td class="text-center">' . $row['countType'] . '</td>';
                                        //             echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 . '</td>';
                                        //             echo "</tr>";
                                        //             $i++;
                                        //         } else if ($i == 3) {
                                        //             echo "<tr>";
                                        //             echo '<th scope="row" class="kanit">?????????????????????????????????????????????</th>';
                                        //             echo '<td class="text-center">' . $row['countType'] . '</td>';
                                        //             echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 . '</td>';
                                        //             $i++;
                                        //             echo "</tr>";
                                        //         } else if ($i == 4) {
                                        //             echo "<tr>";
                                        //             echo '<th scope="row" class="kanit">??????????????????????????????????????????????????????</th>';
                                        //             echo '<td class="text-center">' . $row['countType'] . '</td>';
                                        //             echo '<td class="text-center">' . $row['countType'] * $row['price'] * 1.07 . '</td>';
                                        //             echo "</tr>";
                                        //             $i = 1;
                                        //         }
                                        //     }
                                        // }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- <h6 class="pl-2 pb-2">Number of Search Results : 998</h6> -->
                                <div class="row pb-3 mt-3">
                                    <!-- <button name="submit" type="submit" class="btn btn-success ">Save</button> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Footer -->
<footer class="text-center text-lg-start text-light mt-5" style="background-color: #395902;">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">????????????????????????????????????????????????</h5>

                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;???????????????????????????????????????????????????????????? ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                    ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                    ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">?????????????????????????????????????????????</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a class="fttf text-light" href="#!">?????????????????????????????????????????????????????????</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">???????????????????????????????????????????????????????????????</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">?????????????????????????????????????????????</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">???????????????????????????</h5>
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
        ?? 2021 Copyright:
        <a class="text-light" href="#!">????????????????????????????????????</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

</html>