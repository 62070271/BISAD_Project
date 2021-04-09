<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_test</title>
    <?php
        session_start();
        if (isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['email']);
            header("Location: logIn_front.php");
        }
    ?>
</head>
<body>
    <div style="text-align: center;">
        <h2>Home Page</h2>
        <?php
            if (isset($_SESSION['email'])) {
                echo "<h4>Welcome: " . $_SESSION['email'] . "</h4>";
                echo "<h4>Welcome: " . $_SESSION['user_name'] . "</h4>";
            }
            if (isset($_SESSION['success'])) {
                echo "<h4>Welcome: " . $_SESSION['success'] . "</h4>";
                unset($_SESSION['success']);
            }
        ?>
        <h3><a href="index.php?logout='1'" style="color: red;">Log Out</a></h3>
    </div>
</body>
</html>