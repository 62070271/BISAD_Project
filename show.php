<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testServer</title>
    <?php
        include('dbserver.php');
    ?>
</head>
<body>
    <?php
        $sql = "SELECT * FROM user;";
        $result = mysqli_query($db_con, $sql);
        $check_row = mysqli_num_rows($result);

        if ($check_row > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo 'ID: ' . $row['user_id'] . '<br>';
                echo 'Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '<br>';
                echo 'Tel: ' . $row['Tel'] . '<br>';
                echo 'E-mail:' . $row['email'] . '<br>';
                echo 'Password: ' . $row['u_password'] . '<br>';
                echo 'Gender: ' . $row['gender'] . '<br>';
                echo 'Year of birth: ' . $row['year_of_birth'] . '<br>';
                echo 'User type: ' . $row['user_type'];
                echo '<br><br><br>';
            }
        }
        else {
            echo '0 rows';
        }
    ?>
</body>
</html>