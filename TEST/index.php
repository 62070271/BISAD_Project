<?php
ob_start();
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("Location: logIn_front.php");
}
if (isset($_SESSION['email'])) {
    if ($_SESSION['user_type'] == 'Financial') {
        header("Location: prove.php?status=loggedIn.php");
    }
    if ($_SESSION['user_type'] == 'Reception') {
        echo '<script>alert("yess")</script>';
        header("Location: scanner.php?status=loggedIn.php");
    }
    $user_name = $_SESSION['user_name'];
    $user_image = $_SESSION['user_image'];
}

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'yourSlipHasBeenUpLoad') {
        echo "<script>" . "alert('Your Slip Has Been Up Load. :)')" . "</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="Datepicka_Fong.S.W/jquery.min.js"></script>
    <script src="Datepicka_Fong.S.W/node_modules/jquery/dist/jquery.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.date.js"></script>
    <script src="Datepicka_Fong.S.W/lib/legacy.js"></script>
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.date.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.time.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Font Rammetto -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="main_css.css">
    <style>
        .box-input-type-card {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
        }

        .carousel-indicators [data-bs-target] {
            border-radius: 50%;
            width: 10px;
            height: 10px;
        }

        .carousel-item {
            transition: transform 2s;
        }

        .carousel-inner {
            object-fit: cover;
            width: 100%;
            height: 20vw;
            overflow: hidden;
            display: block;
        }

        html {
            scroll-behavior: smooth;
        }

        /* .show_calendar {
            display: none;
        } */

        body {
            background-color: black;
            /* background-image: url(Web_Image/cat1920x1080.png);
            background-repeat: no-repeat;
            background-position: top -90px right -90px;
            background-size: cover;
            background-attachment: fixed; */
        }

        .carousel,
        .carousel-inner {
            height: 50vh;
            display: flex;
            align-items: center;
        }

        .navbar {
            z-index: 10001;
        }

        .navbar2 {
            z-index: 10000;
        }

        .circle_img {
            /* vertical-align: middle; */
            object-fit: none;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            overflow: hidden;
            position: relative;
        }

        a:link {
            text-decoration: none;
        }

        /* .fl_row {
            --bs-gutter-x: 0rem;
            --bs-gutter-y: 0rem;
        } */
    </style>
    <!-- icon -->
    <link rel="shortcut icon" type="image/x-icon" class="rounded-circle" href="Web_Image/Logo_Web.ico" />
    <title>Homepage</title>
</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #395902;">
        <div class="container">
            <a class="navbar-brand rammeto" href="index.php">
                <img src="Web_Image/Logo300X300v4.png" alt="" width=" 32" height="32" class="d-inline-block align-text-top rounded-circle">
                ZOO
            </a>
            <?php
            if (isset($_SESSION['email'])) {
            ?>
                <!-- dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FBB03B;">
                        <img src='user_images/<?php echo $_SESSION["user_image"] ?>' alt='' width='25' height='25' class='d-inline-block align-text-top rounded-circle'>&nbsp<?php echo $_SESSION['user_name'] . ' '; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Profile&QR_Code.php">Profile & QR Code</a></li>
                        <li><a class="dropdown-item" href="Editprofile.php">Edit profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php?logout=1">Log out</a></li>
                    </ul>
                </div>
            <?php
            } else if (!isset($_SESSION['email'])) {
            ?>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link rounded text-dark" href="logIn_front.php" style="background-color: #FBB03B;">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="reg_front.php">Sign Up</a>
                        </li>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>
    <nav class="navbar navbar2  smart-scroll navbar-expand-lg navbar-ligt" style="opacity:0.85; background-color: #395902;">
        <ul class="navbar-nav" style='margin-left:58.8%;'>
            <li class="nav-item">
                <a class="nav-link" style="color: #FBB03B" href="#intro">Introducing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #FBB03B" href="#content-2">Orange zone</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #FBB03B" href="#content-3">Blue zone</a>

            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #FBB03B" href="#content-4">Green zone</a>
            <li class="nav-item">
                <a class="nav-link" style="color: #FBB03B" href="#content-5">Our animals</a>
        </ul>
    </nav>
    <!-- Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <!-- <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button> -->
        </div>
        <div class="carousel-inner img-fluid">
            <div class="carousel-item active" data-bs-interval="6000">
                <img src="Web_Image/pexels-magda-ehlers-1599452.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item img-fluid" data-bs-interval="6000">
                <img src="https://images.pexels.com/photos/247376/pexels-photo-247376.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item img-fluid" data-bs-interval="6000">
                <img src="Web_Image\pexels-diego-madrigal-2062314.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <!-- <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div> -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container" style="font-family: sans-serif;">
        <div class="row" style="margin-top: 5vw">
            <div class="col" style="text-align: center;">
                <h1 style="text-align: center;" class="homepage_name1 text-warning rammeto ptyellow">Book Tickets</h1>
                <!-- <h2 style="text-align: center;" class="homepage_name2 text-warning">เลือกบัตร</h2> -->
            </div>
        </div>
        <div class="row mt-5" style="text-align: center;">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 'Please pick date before booking the ticket!') {
                    echo "<script>alert('Please pick date before booking the ticket!')</script>";
                }
            }
            if (isset($_GET["status_date"])) {
                // echo '<style>.homepage_name1 {display: none;}</style>';
                echo '<style>.homepage_name2 {display: inline;}</style>';
                echo '<style>.br-display {display: none;}</style>';
                echo '<style>.show_calendar {display: none;}</style>';
                echo '<style>.num_book {display: inline;}</style>';
                echo '<style>.textdate {display: inline;}</style>';
                echo '<div class="col-5 pl-1 text-warning"><h1>วันที่เลือก : ' . $_SESSION['$date'] . '</h1></div>';
                echo  '<div class="col-7 pr-5 text-warning"><h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspจำนวนบัตรที่ถูกจองไป : ' . $_SESSION['number_booking'] . '</h1></div>';
            } else {
                echo '<style>.homepage_name1 {display: inline;}</style>';
                echo '<style>.homepage_name2 {display: none;}</style>';
                echo '<style>.br-display {display: inline;}</style>';
                echo '<style>.show_calendar {display: inline;}</style>';
                echo '<style>#num_book {display: none;}</style>';
            }
            ?>
        </div>
        <div class="row show_calendar">
            <form action="index_back.php" method="POST" name="pick_day" onsubmit="return validateForm()">
                <div class="col-cnt">
                    <div class='card justify-content-md-end' style="width: 50rem; height: 12rem; margin : auto;">
                        <div class="card-body card-body-date">
                            <h2 style="text-align: center;">เลือกวันที่ต้องการจองบัตร</h2>
                            <label for="datepicker">Enter Date : <span class="form-text text-danger">หมายเหตุ
                                    การจองบัตรต้องเลือกก่อน&nbsp1&nbspวันก่อนมาเข้าชม.</span></label>
                            <input class="datepicker form-control" name="date" id="date" aria-owns="date_1_root" aria-hidden='false' placeholder="pick date">
                            <!-- <div class="form-text text-danger">หมายเหตุ การจองบัตรต้องเลือกก่อน&nbsp1&nbspวันก่อนมาเข้าชม.</div> -->
                            <div class="row">
                                <div class="col-10">
                                </div>
                                <div class="col-2 pl-2 d-flex justify-content-center">
                                    <button class="btn btn-primary flex-row-reverse mt-3" type="submit" name="pick_date">Choose</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class='br-display'>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        </div>




        <div class="row ">
            <div class="col pl-5">
                <form action="index_back.php" method="POST" name="book" onsubmit="return validateForm()">
                    <div class='card ml-5 ' id='num_book' style="width: 50rem; height: 41rem; margin : auto; margin-top:4vw; margin-bottom: 3vw;">
                        <div class="card-body ">
                            <h2 class='rammeto' style="color:#395902; text-align: center;">Select Ticket</h2>
                            <?php
                            include('dbserver.php');
                            $sql = "SELECT * FROM TICKET WHERE ticket_id = 1";
                            $result = mysqli_query($db_con, $sql);
                            $check_row = mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo "<script>alert('" . $row['first_name'] . "')</script>";
                                $_SESSION['card_detail_1'] = $row['description'];
                                $_SESSION['card_price_1'] = $row['price'];
                                $_SESSION['ticket_kid_1'] = $row['ticket_id'];
                            }
                            $sql = "SELECT * FROM TICKET WHERE ticket_id = 2";
                            $result = mysqli_query($db_con, $sql);
                            $check_row = mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo "<script>alert('" . $row['first_name'] . "')</script>";
                                $_SESSION['card_detail_2'] = $row['description'];
                                $_SESSION['card_price_2'] = $row['price'];
                                $_SESSION['ticket_adult_1'] = $row['ticket_id'];
                            }
                            $sql = "SELECT * FROM TICKET WHERE ticket_id = 5";
                            $result = mysqli_query($db_con, $sql);
                            $check_row = mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo "<script>alert('" . $row['first_name'] . "')</script>";
                                $_SESSION['card_detail_3'] = $row['description'];
                                $_SESSION['card_price_3'] = $row['price'];
                                $_SESSION['ticket_kid_2'] = $row['ticket_id'];
                            }
                            $sql = "SELECT * FROM TICKET WHERE ticket_id = 6";
                            $result = mysqli_query($db_con, $sql);
                            $check_row = mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo "<script>alert('" . $row['first_name'] . "')</script>";
                                $_SESSION['card_detail_4'] = $row['description'];
                                $_SESSION['card_price_4'] = $row['price'];
                                $_SESSION['ticket_adult_2'] = $row['ticket_id'];
                            }
                            ?>

                            <div class="row bg-light " style="padding-left: 30px;">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5 style="color:#395902;">บัตรเด็ก</h5>
                                        <div class='box-detail'>
                                            <p>
                                                <?php echo  $_SESSION['card_detail_1'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>&nbsp&nbspTHB&nbsp
                                            <?php echo $_SESSION['card_price_1'] ?>
                                        </h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <!-- <label for="type-card-1">number:</label> -->
                                        <input class="type-card-1" type="number" step="any" min="0" value="0" max="35" name="type-card-1" id="type-card-1">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 30px;">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5 style="color:#395902;">บัตรผู้ใหญ่</h5>
                                        <div class='box-detail'>
                                            <p>
                                                <?php echo  $_SESSION['card_detail_2'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>&nbsp&nbspTHB&nbsp
                                            <?php echo $_SESSION['card_price_2'] ?>
                                        </h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <!-- <label for="type-card-1">number:</label> -->
                                        <input class="type-card-2" type="number" step="any" min="0" value="0" max="35" name="type-card-2" id="type-card-2">
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light" style="padding-left: 30px;">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5 style="color:#395902;">Foreigner: Kid <br>(บัตรเด็ก: ชาวต่างชาติ)</h5>
                                        <div class='box-detail'>
                                            <p>
                                                <?php echo  $_SESSION['card_detail_3'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>&nbsp&nbspTHB&nbsp
                                            <?php echo $_SESSION['card_price_3'] ?>
                                        </h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <!-- <label for="type-card-1">number:</label> -->
                                        <input class="type-card-3" type="number" step="any" min="0" value="0" max="35" name="type-card-3" id="type-card-3">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 30px;">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5 class="mt-2" style="color:#395902;">Foreigner: Adult <br>(บัตรผู้ใหญ่:
                                            ชาวต่างชาติ)</h5>
                                        <div class='box-detail'>
                                            <p>
                                                <?php echo  $_SESSION['card_detail_4'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>&nbsp&nbspTHB&nbsp
                                            <?php echo $_SESSION['card_price_4'] ?>
                                        </h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <!-- <label for="type-card-1">number:</label> -->
                                        <input class="type-card-4" type="number" step="any" min="0" value="0" max="35" name="type-card-4" id="type-card-4">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 35px;">
                                <div class="col-8"></div>
                                <!-- <div class='col-1 d-grid gap-2 d-md-flex justify-content-md-end'>
                                    </div> -->
                                <div class="col-4 d-flex justify-content-end">
                                    <form action="index_back.php" method="POST" name="book" onsubmit="return validateForm()">
                                        <button class="btn btn-secondary mt-3 rammeto" type="submit" name="back" style="margin-right: 8px;">Back</button>
                                    </form>
                                    <button class="btn btn-primary mt-3 rammeto" type="submit" name="payment">Purchase</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == 'Please select the number of reservations.') {
                        echo "<script>alert('Please select the number of reservations.')</script>";
                    }
                }
                ?>

            </div>
            <div>
                <div id='content-1' style='height: 45px;'></div>
            </div>
            <div id='intro' class="row  mt-5 pt-5">
                <div class="col-8">
                    <h1 class=" m-4 rammeto ptyellow lh-base">Introducing</h1>
                    <p class="fs-5 text-white"> สวนสัตว์คนพันธุ์เสือประเทศไทยที่มีมานานกว่า 60 ปีแล้ว บนเนื้อที่กว่า 5,000
                        ไร่อันกว้างขวางของจังหวัดชลบุรี นอกจากเหล่าสัตว์น้อยใหญ่นานาพันธุ์กว่า 300 ชนิด
                        กิจกรรมและการแสดงโชว์สัตว์แสนรู้อีกหลายการแสดงในพื้นที่สวนสัตว์เปิดเขาเขียวแห่งนี้
                        ภายในบริเวณ สวนสัตว์ประกอบไปด้วยส่วนต่างๆ เช่น Orange zone, Blue zone, Green zone
                    </p>
                </div>
            </div>
            <div id='content-2' style='height: 45px;'></div>
            <div id='card-zone' class="row">
                <div class='col' id='content--2'>
                    <div class="card-group m-0 p-0">
                        <div class="card bg-black" style="height: 40rem; background-color: #000;">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class='col-6 p-0 m-0' style="font-size: 1.25rem">
                                        <div class="row p-0 m-0" style="height: 50%;">
                                            <div class='col p-2 m-0'>
                                                <h3 class=" m-2 rammeto ptyellow lh-base">Orange zone</h1>
                                                    <p class="card-text text-white">โซนนี้ประกอบไปด้วย
                                                        <br>- สัตว์ป่า เช่น ยีราฟ ม้าลาย นกกระจอกเทศ เสือโคร่ง สิงโต
                                                        ลิงและค่างชนิดต่างๆ
                                                        <br>- สัตว์เลื้อยคลาน เช่น เต่า งู กิ้งก่า กบยักษ์แอฟริกัน
                                                        สีสันแปลกตา
                                                        <br>- สัตว์ป่าสงวนของไทย เช่น เก้งหม้อเผือก ที่หาดูได้ยาก
                                                    </p>
                                                    <button class=" btn rammeto border-2 border-warning ptyellow" style="margin-top: 20px;"> View details</button>
                                            </div>
                                        </div>
                                        <div class="row p-0 m-0" style="height: 70%;">
                                            <div class='col p-0 m-0'>
                                                <img src="https://images.pexels.com/photos/2263936/pexels-photo-2263936.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" style=" object-fit: none; display: inline-block; overflow: hidden; position: relative; width: 100%; height: 20rem;" class="card-img-bottom img-fluid" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-6 p-0 m-0'>
                                        <img src="https://images.pexels.com/photos/922519/pexels-photo-922519.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=350" style=" object-fit: none; display: inline-block; overflow: hidden; position: relative; width: 98.5%; height: 20rem;" class="card-img img-fluid" alt="...">
                                        <img src="https://static.thainationalparks.com/img/species/2013/11/25/7976/indian-muntjac-w-900.jpg" style=" object-fit: none; display: inline-block; overflow: hidden; position: relative; width: 98.5%; height: 20rem;" class="card-img-right img-fluid" alt="...">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- <div id='content-3' style='height: 10px;'></div> -->
            <div id='content-3' class="row mt-5 mb-1">
                <h2 class=" mt-5 text-center rammeto ptyellow lh-base">Blue zone</h2>
                <div class="col-6" style="height: 40rem;">
                    <img class="rounded-circle circle_img" src="https://static.thairath.co.th/media/PZnhTOtr5D3rd9ocK40waJor2MBKJwCcgOtJ6SlFesqczhb.webp" alt="Generic placeholder image" width="350" height="350">
                    <h2 class="mt-4 mb-2 text-white">กายกรรมประเทศเคนยา</h2>
                    <p class="fs-5 text-white">นอกจากเดินชมสัตว์ชนิดต่างๆ ได้อย่างเพลิดเพลินแล้ว ยังมีการแสดงให้ชมด้วย
                        หนึ่งในนั้นคือ การแสดงกายกรรมจากประเทศเคนยา มีทั้งการโชว์เต้นลอดไม่กั้น การกระโดดทะลุห่วง
                        กระโดดเชือก กายกรรมต่อตัว เป็นต้น</p>
                    <button class=" btn rammeto border-2 border-warning ptyellow"> View details</button>
                </div>
                <div class="col-6" style="height: 30rem;">
                    <img class="rounded-circle circle_img" src="https://static.thairath.co.th/media/PZnhTOtr5D3rd9ocK40waJor2MBKJwCcgkkZ6op4apFhInW.webp" alt="Generic placeholder image" width="350" height="350">
                    <h2 class="mt-4 mb-2 text-white">การแสดงแมวน้ำ</h2>
                    <p class=" fs-5 text-white">อีกหนึ่งการแสดงที่น่าชมไม่แพ้กัน ก็คือ การแสดงแมวน้ำ
                        จะมีเจ้าหน้าที่ครูฝึกและน้องแมวน้ำสุดน่ารักออกมาแสดงความสามารถให้ชมกันอย่างเพลิดเพลิน</p>
                    <button class=" btn rammeto border-2 border-warning ptyellow" style="margin-top: 30px;"> View
                        details</button>
                </div>
            </div>
            <div id='content-4' style='height: 45px;'></div>
            <div class="row " style="margin-bottom: 40px;">
                <div class='col'>
                    <div class="card bg-dark" style="height: 25rem; ">
                        <img class="card-img" src="https://images.pexels.com/photos/1436495/pexels-photo-1436495.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=650" style="image-rendering:auto; object-fit: none; display: inline-block; overflow: hidden; position: relative; width: 100%; height: 25rem;" class="card-img img-fluid" alt="Card image">
                        <div class="card-img-overlay">
                            <h1 class=" rammeto ">Green zone</h1>
                            <h5 class=""><b>โซนนี้ประกอบไปด้วย<br>สัตว์ปีก เช่น นกกก(นกกาฮัง, นกกะวะ หรือ นกอีฮาก),
                                    <br>นกกระตั้วดำ, นกกระตั้วใหญ่หงอนเหลือนกแก้ว<br></b></h5>
                            <button class=" btn rammeto border-2 border-dark " style="margin-top: 28px;"> View
                                details</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Our ZOO -->
            <div id='content-5' style='height: 45px;'></div>
            <div class="container mt-5 d-flex justify-content-center align-items-center">
                <div class="row" style="--bs-gutter-x: 0rem;">
                    <div class="col-sm-6 ">
                        <div class="row " style="--bs-gutter-x: 0rem;">
                            <div class="col-sm-12 " style="width: 100%; height: 30vh;">
                                <h3 class="rammeto ptyellow">Our animals</h3>
                                <p class="text-white">ภาพตัวอย่างของสัตว์แสนน่ารักในสวนสัตว์ของเรา</p>
                                <button class="btn rammeto border-2 border-warning ptyellow"> See all animales</button>
                            </div>
                        </div>
                        <div class="row" style="--bs-gutter-x: 0rem;">
                            <div class="col-sm-6">
                                <img class="img-fluid" style="width: 100%; height: 60vh;" src="https://images.pexels.com/photos/4577132/pexels-photo-4577132.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                            </div>
                            <div class="col-sm-6 ">
                                <div class="row ">
                                    <div class="col-sm-12 ">
                                        <img class="img-fluid" style="width: 100%; height: 30vh;" src="https://images.pexels.com/photos/3712289/pexels-photo-3712289.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-12 ">
                                        <img class="img-fluid" style="width: 100%; height: 30vh;" src="https://images.pexels.com/photos/704434/pexels-photo-704434.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="row " style="--bs-gutter-x: 0rem;">
                            <div class="col-sm-12 ">
                                <img class="img-fluid" style="width: 100%; height: 60vh;" src="https://images.pexels.com/photos/4751260/pexels-photo-4751260.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                            </div>
                        </div>
                        <div class="row" style="--bs-gutter-x: 0rem;">
                            <div class="col-sm-6 ">
                                <img class="img-fluid" style="width: 100%; height: 30vh;" src="https://images.pexels.com/photos/735174/pexels-photo-735174.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                            </div>
                            <div class="col-sm-6 ">
                                <img class="img-fluid" style="width: 100%; height: 30vh;" src="https://cdn.pixabay.com/photo/2018/04/08/16/46/caiman-3301709_960_720.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <script>
            // PICKADATE FORMATTING
            var $input = $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                // An integer (positive/negative) sets it relative to today.
                min: 1,
                // `true` sets it to today. `false` removes any limits.
                // max: 15
                inline: true,
                sideBySide: true,
                closeOnSelect: false,
                closeOnClear: false,
                today: ''
                // close: false
            });
            var picker = $input.pickadate('picker');
            picker.$node.addClass('picker__input--active picker__input--target');
            picker.$node.attr('aria-expanded', 'true');
            picker.$root.addClass('picker--focused picker--opened');
            picker.$root.attr('aria-hidden', 'false');
        </script>
        <style>
            .picker__holder {
                text-align: center;
                margin-left: 7.25vw;
                line-height: 1.5;
                display: inline-block;
                vertical-align: middle;

            }

            .card-body-date {
                font-family: sans-serif;
            }
        </style>
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
                <h5 class="text-uppercase">ที่มาของสวนสัตว์</h5>

                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สวนสัตว์คนพันธุ์เสือ
                    ได้นำสวนสัตว์เข้ามาผสมผสานกับความสมบูรณ์ของ
                    ป่าไม้ภายในพื้นที่โดยใช้การอนุรักษ์และหาประโยชน์จากสภาพผืนป่าแบบระมัดระวังและรอบคอบ
                    ไม่ให้มีการเปลี่ยนแปลงสภาพพื้นที่ของป่า และลดการทำลายสภาพพื้นที่เดิมให้มากที่สุด
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">ข้อมูลเพิ่มเติม</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a class="fttf text-light" href="#!">ข้อกำหนดและเงื่อนไข</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">นโยบายความเป็นส่วนตัว</a>
                    </li>
                    <li>
                        <a class="fttf text-light" href="#!">บริการช่วยเหลือ</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">ติดต่อเรา</h5>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <a class="text-light" href="#!"><svg width="30" height="30" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="line" class="svg-inline--fa fa-line fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M272.1 204.2v71.1c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.1 0-2.1-.6-2.6-1.3l-32.6-44v42.2c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.8 0-3.2-1.4-3.2-3.2v-71.1c0-1.8 1.4-3.2 3.2-3.2H219c1 0 2.1.5 2.6 1.4l32.6 44v-42.2c0-1.8 1.4-3.2 3.2-3.2h11.4c1.8-.1 3.3 1.4 3.3 3.1zm-82-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 1.8 1.4 3.2 3.2 3.2h11.4c1.8 0 3.2-1.4 3.2-3.2v-71.1c0-1.7-1.4-3.2-3.2-3.2zm-27.5 59.6h-31.1v-56.4c0-1.8-1.4-3.2-3.2-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 .9.3 1.6.9 2.2.6.5 1.3.9 2.2.9h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.7-1.4-3.2-3.1-3.2zM332.1 201h-45.7c-1.7 0-3.2 1.4-3.2 3.2v71.1c0 1.7 1.4 3.2 3.2 3.2h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2V234c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2v-11.4c-.1-1.7-1.5-3.2-3.2-3.2zM448 113.7V399c-.1 44.8-36.8 81.1-81.7 81H81c-44.8-.1-81.1-36.9-81-81.7V113c.1-44.8 36.9-81.1 81.7-81H367c44.8.1 81.1 36.8 81 81.7zm-61.6 122.6c0-73-73.2-132.4-163.1-132.4-89.9 0-163.1 59.4-163.1 132.4 0 65.4 58 120.2 136.4 130.6 19.1 4.1 16.9 11.1 12.6 36.8-.7 4.1-3.3 16.1 14.1 8.8 17.4-7.3 93.9-55.3 128.2-94.7 23.6-26 34.9-52.3 34.9-81.5z">
                                </path>
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
        © 2021 Copyright:
        <a class="text-light" href="#!">คนพันธุ์เสือ</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

</html>