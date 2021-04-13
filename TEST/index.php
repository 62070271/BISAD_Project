<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
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
    <div class="container">
        <div class="row" style="margin-top: 10vw">
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
        <form action="reg_back.php" method="POST" name="reg" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-12">
                    <div class='card' style="width: 50rem; height: 25rem; margin : auto;">
                        <div class="card-body">
                            <h2 style="text-align: center;">Book Tickets</h2>
                            <label for="datepicker">Enter Date</label>
                            <input class="datepicker form-control" name="date_1" id="date_1" aria-owns="date_1_root" aria-hidden='false'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class='card ' style="width: 50rem; height: 40rem; margin : auto; margin-top:5vw">
                        <div class="card-body">
                            <h2 style="text-align: center;">Ticket type</h2>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 150px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรเด็ก</h5>
                                        <p>*******************************************************</p>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :xxx</h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="" type="number" step="any" name="type-card-1" id="type-card-1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 150px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรเด็ก</h5>
                                        <p>*******************************************************</p>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :xxx</h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="" type="number" step="any" name="type-card-1" id="type-card-1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-input-type-card" style="height: 150px;">
                                    <div class="col-detail" style="width: 50%;">
                                        <h5>บัตรเด็ก</h5>
                                        <div class='box-detail'>
                                        <p>*******************************************************</p>
                                        </div>
                                    </div>
                                    <div class="col-price" style="width: 20%;">
                                        <h5>ราคาบัตร :xxx</h5>
                                    </div>
                                    <div class="col-price" style="width: 10%;">
                                        <label for="type-card-1">number:</label>
                                        <input class="" type="number" step="any" name="type-card-1" id="type-card-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>


    </div>
    <script>
        // PICKADATE FORMATTING
        var $input = $('.datepicker').pickadate({
            format: 'dd-mm-yyyy',
            // An integer (positive/negative) sets it relative to today.
            min: 0,
            // `true` sets it to today. `false` removes any limits.
            // max: 15
            inline: true,
            sideBySide: true,
            closeOnSelect: false,
            closeOnClear: false,
            close: false
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