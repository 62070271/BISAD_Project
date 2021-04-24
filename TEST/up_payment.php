<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container pt-5">


        <div class="bank online">
            <div class='card' style="width: 50rem; height: 10rem; margin : auto;">
                <div class="row">
                    <div class="col-3">
                        <img src="http://pngimg.com/uploads/bank/bank_PNG3.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-6 p-4">
                        <span>เลขที่บัณชีโอน</span>
                        <h1>123456789</h5>
                    </div>
                    <div class="col-3">
                        <img src="https://www.pngfind.com/pngs/b/40-401545_caras-memes-png-you-fucking-kidding-me-transparent.png" class="img-fluid p-4" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="detail_payment pt-5">
            <?php
            session_start();
            $_SESSION['sum_price'] = 0;
            $_SESSION['total_quantity'] = 0;
            ?>
            <div class='card p-5 mb-5' style="width: 50rem; margin : auto;">
            <!-- height: 32rem; -->
                <div class="row">
                    <div class="col">
                        <h3 class="pb-3">Summary price</h3>
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
                                    echo '<td>' . $_SESSION['sum_type_1'] . '</td>';
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
                                    echo '<td>' . $_SESSION['sum_type_2'] . '</td>';
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
                                    echo '<td>' . $_SESSION['sum_type_3'] . '</td>';
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
                                    echo '<td>' . $_SESSION['sum_type_4'] . '</td>';
                                    echo '</tr>';
                                    $_SESSION['sum_price'] = $_SESSION['sum_price'] + (int)$_SESSION['sum_type_4'];
                                    $_SESSION['total_quantity'] = $_SESSION['total_quantity'] + (int)$_SESSION['$num_type_4'];
                                }
                                $_SESSION['sum_price_vat'] = (float)($_SESSION['sum_price'] *1.07);
                                ?>
                        </table>
                        <h3 class='pr-3 mr-5'>Total Price and vat 7% :<?php echo (float)$_SESSION['sum_price_vat']; ?></h3>
                    </div>
                </div>

                <div class='row' >
                    <div class='col-7'>
                    </div>
                    <div class='col-5'>
                        
                        <form style="display: inline;" action="up_payment_back.php" method="POST" name="back_payment_" onsubmit="return validateForm()"><button class="btn btn-success mr-5" type="submit" name="back_payment">later</button></form>

                        <form style="display: inline;" action="up_payment_back.php" method="POST" name="upload_payment_" onsubmit="return validateForm()"><button class="btn btn-success " type="submit" name="upload_payment">Upload Payment</button></form>
                    </div>
                </div>

                    
            </div>

        </div>


    </div>

</body>

</html>