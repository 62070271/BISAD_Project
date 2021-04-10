<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <div style="text-align: center;">
        <form action="logIn_back.php" method="POST" onsubmit="" name="logIn">
            <h2>Log In</h2>
            <input type="text" name="email" placeholder="E-mail">
            <br><br>
            <input type="password" name='password' placeholder="Password">
            <br><br>
            <button type="submit" name="submit">Log In!</button>
        </form>
        <h5>Create your account. <a href="reg_front.php">Sign Up!</a></h5>
    </div>

    <?php
            if (isset($_GET["error"])) {
                if (($_GET["error"]) == "Wrongemailorpassword!") {
                    echo "<script>alert('Wrong email or password')</script>";
                }
            }
    ?>
</body>
</html>