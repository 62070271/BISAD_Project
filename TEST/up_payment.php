<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <!-- Font Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!-- Font Rammetto -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- CSS Style -->
    <title>Upload Payment</title>
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

        html {
            scroll-behavior: smooth;
        }

        /* .show_calendar {
            display: none;
        } */

        body {
            background-image: url(Web_Image/lion-width4000__heal.png);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }

        .homepage_name {
            font-family: 'Rammetto One', cursive;
        }

        .carousel,
        .carousel-inner {
            height: 60vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    if (isset($_SESSION['email'])) {
        // if ($_SESSION['user_type'] == 'Financial') {
        //     echo '<script>alert("yess")</script>';
        //     header("Location: prove.php?status=loggedIn.php");
        // }
        // if ($_SESSION['user_type'] == 'Reception') {
        //     echo '<script>alert("yess")</script>';
        //     header("Location: scanner.php?status=loggedIn.php");
        // }
        $user_name = $_SESSION['user_name'];
        $user_image = $_SESSION['user_image'];
    }
    ?>

    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #395902;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/20210413885810631.jpg" alt="" width=" 30" height="30" class="d-inline-block align-text-top border border-white rounded-circle">
                ZOO
            </a>
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
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <!-- <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button> -->
        </div>
        <div class="carousel-inner img-fluid">
            <div class="carousel-item active" data-bs-interval="6000">
                <img src="https://wallpapercave.com/wp/wp4841327.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item img-fluid" data-bs-interval="6000">
                <img src="https://d3tidaycr45ky4.cloudfront.net/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/l/planet-zoo--australia-pack.jpg" class="d-block w-100" alt="...">
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
    <div class="container pt-5" style="font-family: 'Kanit', sans-serif;">
        <div class="bank online">
            <div class='card' style="width: 50rem; height: 10rem; margin : auto;">
                <div class="row">
                    <div class="col-3">
                        <img src="http://pngimg.com/uploads/bank/bank_PNG3.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-6 p-4">
                        <span style="color:#395902;">เลขที่บัณชีโอน</span>
                        <h1>123456789</h5>
                    </div>
                    <div class="col-3">
                        <img src="qrcodes/MEI'S_QR.png" class="img-fluid p-4" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="detail_payment pt-5">
            <?php
            // session_start();
            $_SESSION['sum_price'] = 0;
            $_SESSION['total_quantity'] = 0;
            ?>
            <div class='card p-5 mb-5' style="width: 50rem; margin : auto;">
                <!-- height: 32rem; -->
                <div class="row">
                    <div class="col">
                        <h3 class="pb-3" style="color:#395902;">Summary price</h3>
                        <table class="table  p-3">
                            <tbody class="pr-4 pl-4">
                                <?php
                                if (isset($_SESSION['$num_type_1'])) {
                                    $_SESSION['sum_type_1'] = (int)$_SESSION['card_price_1'] * (int)$_SESSION['$num_type_1'];
                                    echo '<tr>';
                                    echo '<th scope="row">';
                                    echo  '<h4>บัตรเด็ก</h4>';
                                    echo '</th>';
                                    echo '<td>' . $_SESSION['card_price_1'] . '</td>';
                                    echo '<td>x</td>';
                                    echo '<td>' . $_SESSION['$num_type_1'] . '</td>';
                                    echo '<td>:&nbsp' . $_SESSION['sum_type_1'] . '</td>';
                                    echo '</tr>';
                                    $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_1'];
                                    $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_1'];
                                }
                                if (isset($_SESSION['$num_type_2'])) {
                                    $_SESSION['sum_type_2'] = (int)$_SESSION['card_price_2'] * (int)$_SESSION['$num_type_2'];
                                    echo '<tr>';
                                    echo '<th scope="row">';
                                    echo  '<h4>บัตรผู้ใหญ่</h4>';
                                    echo '</th>';
                                    echo '<td>' . $_SESSION['card_price_2'] . '</td>';
                                    echo '<td>x</td>';
                                    echo '<td>' . $_SESSION['$num_type_2'] . '</td>';
                                    echo '<td> :&nbsp' . $_SESSION['sum_type_2'] . '</td>';
                                    echo '</tr>';
                                    $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_2'];
                                    $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_2'];
                                }
                                if (isset($_SESSION['$num_type_3'])) {
                                    $_SESSION['sum_type_3'] = (int)$_SESSION['card_price_3'] * (int)$_SESSION['$num_type_3'];
                                    echo '<tr>';
                                    echo '<th scope="row">';
                                    echo  '<h4>บัตรเด็กต่างชาติ</h4>';
                                    echo '</th>';
                                    echo '<td>' . $_SESSION['card_price_3'] . '</td>';
                                    echo '<td>x</td>';
                                    echo '<td>' . $_SESSION['$num_type_3'] . '</td>';
                                    echo '<td> :&nbsp' . $_SESSION['sum_type_3'] . '</td>';
                                    echo '</tr>';
                                    $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_3'];
                                    $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_3'];
                                }
                                if (isset($_SESSION['$num_type_4'])) {
                                    $_SESSION['sum_type_4'] = (int)$_SESSION['card_price_4'] * (int)$_SESSION['$num_type_4'];
                                    echo '<tr>';
                                    echo '<th scope="row">';
                                    echo  '<h4>บัตรผู้ใหญ่ต่างชาติ</h4>';
                                    echo '</th>';
                                    echo '<td>' . $_SESSION['card_price_4'] . '</td>';
                                    echo '<td>x</td>';
                                    echo '<td>' . $_SESSION['$num_type_4'] . '</td>';
                                    echo '<td> :&nbsp' . $_SESSION['sum_type_4'] . '</td>';
                                    echo '</tr>';
                                    $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_4'];
                                    $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_4'];
                                }
                                $_SESSION['sum_price_vat'] = (float)($_SESSION['sum_price'] * 1.07);
                                ?>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 style="color:#395902;" class='pr-3 mr-5'>Total price and vat 7% :&nbsp&nbsp<?php echo (float)$_SESSION['sum_price_vat']; ?></h3>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-7'>
                    </div>
                    <div class='col-5'>

                        <form style="display: inline;" action="up_payment_back.php" method="POST" name="back_payment_" onsubmit="return validateForm()"><button class="btn btn-success mr-5" style="margin-left: 25px; margin-right: 30px;" type="submit" name="back_payment">later</button></form>

                        <form style="display: inline;" action="up_payment_back.php" method="POST" name="upload_payment_" onsubmit="return validateForm()"><button class="btn btn-success " style="margin-left: 15px;" type="submit" name="upload_payment">Upload Payment</button></form>
                    </div>
                </div>


            </div>

        </div>

    </div>

</body>
<footer class="text-center text-lg-start text-light" style="background-color: #395902;">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>

                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                    molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                    voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

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
        © 2020 Copyright:
        <a class="text-light" href="#!">คนพันธุ์เสือ</a>
    </div>
    <!-- Copyright -->
</footer>

</html>