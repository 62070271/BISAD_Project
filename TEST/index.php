<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
    <script src="Datepicka_Fong.S.W/jquery.min.js"></script>
    <script src="Datepicka_Fong.S.W/node_modules/jquery/dist/jquery.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.date.js"></script>
    <script src="Datepicka_Fong.S.W/lib/legacy.js"></script>
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.date.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.time.css">
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
            height: 25vw;
            overflow: hidden;
            display: block;
        }

        /* .show_calendar {
            display: none;
        } */
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    ?>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <!-- <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button> -->
        </div>
        <div class="carousel-inner img-fluid">
            <div class="carousel-item active" data-bs-interval="6000">
                <img src="https://images.wallpapersden.com/image/download/planet-zoo_a2lpZ2aUmZqaraWkpJRnamtlrWZlbWU.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item img-fluid" data-bs-interval="6000">
                <img src="https://d3tidaycr45ky4.cloudfront.net/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/l/planet-zoo--australia-pack.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
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
    <div class="container">
        <div class="row" style="margin-top: 5vw">
            <div class="col" style="text-align: center;">
                <h2 style="text-align: center;">Home Page</h2>
                <?php
                if (isset($_SESSION['email'])) {
                    echo "<h4>Welcome: " . $_SESSION['email'] . "</h4>";
                    echo "<h4>Welcome: " . $_SESSION['user_name'] . "</h4>";

                    echo "<br>";
                    echo '<h3><a href="index.php?logout=1" style="color: red; text-align: center;">Log Out</a></h3>';
                    echo "<br>";
                    echo '<h3><a href="Editprofile.php" style="color: blue;">Editprofile</a></h3>';
                }
                if (isset($_SESSION['success'])) {
                    echo "<h4>Welcome: " . $_SESSION['success'] . "</h4>";
                    unset($_SESSION['success']);
                } else if (!isset($_SESSION['email'])) {
                    echo "<h3><a style='color: red;' href='logIn_front.php'>Log in</a></h3>";
                }
                ?>
            </div>
        </div>

        <div class="row show_calendar">
            <form action="index_back.php" method="POST" name="pick_day" onsubmit="return validateForm()">
                <div class="col-12">
                    <div class='card' style="width: 50rem; height: 25rem; margin : auto;">
                        <div class="card-body">
                            <h2 style="text-align: center;">Book Tickets</h2>
                            <label for="datepicker">Enter Date</label>
                            <input class="datepicker form-control" name="date" id="date" aria-owns="date_1_root" aria-hidden='false' placeholder="pick date">
                            <button class="btn btn-success mt-3" type="submit" name="pick_date">Choose a date</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row mt-5" style="text-align: center;">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 'Please pick date before booking the ticket!') {
                    echo "<script>alert('Please pick date before booking the ticket!')</script>";
                }
            }
            if (isset($_GET["status_date"])) {
                echo '<style>.show_calendar {display: none;}</style>';
                echo '<style>.num_book {display: inline;}</style>';
                echo '<style>.textdate {display: inline;}</style>';
                echo '<div class="col-6 pl-5"><h3>Set : ' . $_SESSION['$date'] . '</h3></div>';
                echo  '<div class="col-6 pr-5"><h3>Booking amount : ' . $_SESSION['number_booking'] . '</h3></div>';
            } else {
                echo '<style>.textdate {display: none;}</style>';
                echo '<style>.show_calendar {display: inline;}</style>';
                echo '<style>#num_book {display: none;}</style>';
                echo '<div class="textdate col-6 pl-5"><h3>Set : yyyy-mm-dd</h3></div>';
                echo  '<div class="textdate col-6 pr-5"><h3>Booking amount : Unknow</h3></div>';
            }
            ?>
        </div>

        <div class="row">
            <div class="col">
                <form action="index_back.php" method="POST" name="book" onsubmit="return validateForm()">
                    <div class='card' id='num_book'  style="width: 50rem; height: 40rem; margin : auto; margin-top:5vw">
                        <div class="card-body">
                            <h2 style="text-align: center;">Ticket type</h2>
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
                            <div class="row">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรเด็ก</h5>
                                        <div class='box-detail'>
                                            <p><?php echo  $_SESSION['card_detail_1']?></p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :<?php echo $_SESSION['card_price_1']?></h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="type-card-1" type="number" step="any" min="0" value="0" max="35" name="type-card-1" id="type-card-1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรผู้ใหญ่</h5>
                                        <div class='box-detail'>
                                            <p><?php echo  $_SESSION['card_detail_2']?></p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :<?php echo $_SESSION['card_price_2']?></h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="type-card-2" type="number" step="any" min="0" value="0" max="35" name="type-card-2" id="type-card-2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรเด็กต่างชาติ</h5>
                                        <div class='box-detail'>
                                            <p><?php echo  $_SESSION['card_detail_3']?></p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :<?php echo $_SESSION['card_price_3']?></h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="type-card-3" type="number" step="any" min="0" value="0" max="35" name="type-card-3" id="type-card-3">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 120px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรผู้ใหญ่ต่างชาติ</h5>
                                        <div class='box-detail'>
                                            <p><?php echo  $_SESSION['card_detail_4']?></p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :<?php echo $_SESSION['card_price_4']?></h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="type-card-4" type="number" step="any" min="0" value="0" max="35" name="type-card-4" id="type-card-4">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-3" type="submit" name="payment">payment</button>
                            <form action="index_back.php" method="POST" name="book" onsubmit="return validateForm()"><button class="btn btn-success mt-3" type="submit" name="back">back</button></form>
                        </div>
                    </div>
                </form>
                <?php
                 if (isset($_GET["error"])) {
                    if ($_GET["error"] == 'Please select the number of reservations.') {
                        echo "<script>alert('Please select the number of reservations.')</script>";
                    }
                    if ($_GET["error"] == 'yessssssssssssssssssssss') {
                        echo "<script>alert('yessssssssssssssssssssss')</script>";
                    }
                 }
                ?>

            </div>
        </div>



    </div>
    <script>
        // PICKADATE FORMATTING
        var $input = $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            // An integer (positive/negative) sets it relative to today.
            min: 0,
            // `true` sets it to today. `false` removes any limits.
            // max: 15
            inline: true,
            sideBySide: true,
            closeOnSelect: false,
            closeOnClear: false,
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
            margin-left: 10vw;
            line-height: 1.5;
            display: inline-block;
            vertical-align: middle;
        }
    </style>

</body>

</html>