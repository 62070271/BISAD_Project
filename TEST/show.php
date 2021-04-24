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

    $sql = "SELECT *
            FROM ORDER_TICKET AS OT
            INNER JOIN ORDERS AS O
            USING (order_id)
            INNER JOIN SLIP_OF_PAYMENT AS SP
            USING (order_id)
            INNER JOIN CONFIRM_SLIP AS CS
            USING (slip_id)
            INNER JOIN TICKET AS T
            USING (ticket_id)
            WHERE O.order_id = 1
            ORDER BY CS.confirm_id ASC;
            ";

    $result = mysqli_query($db_con, $sql) or die("Error in query: $sql " . mysqli_error($db_con));
    $check_row = mysqli_num_rows($result);

    
    $quantity_thkid = 0;
    $quantity_thad = 0;
    $quantity_fkkid = 0;
    $quantity_fkad = 0;

    if ($check_row > 0) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $order_id = $row['order_id'];
            $confirm_id = $row['confirm_id'];
            $totalpriceVat = $row['total_price_and_vat'];
            $countofSale = $row['total_quantity'];


            if ($row['type'] == 'Thai_kid') { $quantity_thkid = $row['quantity']; }
            else if ($row['type'] == 'Thai_adult')  { $quantity_thad =  $row['quantity']; }
            else if ($row['type'] == 'Foreigner_kid') { $quantity_fkkid = $row['quantity']; }
            else if ($row['type'] == 'Foreigner_Adult') { $quantity_fkad = $row['quantity']; }
        }
    }
    else {echo '0 rows';}

    echo 'Order id: ' . $order_id . '<br/>';
    echo 'confirm_id: ' . $confirm_id . '<br/>';
    echo 'totalpriceVat: ' . $totalpriceVat . '<br/>';
    echo 'total_quantity: ' . $countofSale . '<br/>';
    echo 'TH_kid: ' . $quantity_thkid . '<br/>';
    echo 'TH_adult: ' . $quantity_thad . '<br/>';
    echo 'FK_kid: ' . $quantity_fkkid . '<br/>';
    echo 'FK_adult: ' . $quantity_fkad . '<br/>';

    ?>
</body>
</html>