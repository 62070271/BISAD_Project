<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testRegister</title>
</head>
<body>
    <div style="text-align: center;">
        <h2>Sign Up</h2>
        <form action="reg_back.php" method="POST" name="reg" onsubmit="return validateForm()">
            <input type="text" name='f_name' placeholder="Firstname">
            <br><br>
            <input type="text" name='l_name' placeholder="Lastname">
            <br><br>
            <input type="text" name='Tel' placeholder="Phone Number">
            <br><br>
            <input type="text" name='email' placeholder="E-mail">
            <br><br>
            <input type="text" name='password' placeholder="Password">
            <br>
            <br>
            <input type="text" name='pwdRepeat' placeholder="Confirm Password">
           
            <p>Gender: 
                <select name="gender" id="">
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                </select>
            </p>
            <input type="text" name='yfb' placeholder="Year of birth">
            <br><br>
            <button type="submit" name="submit">Sign Up!</button>
        </form>

        <?php
            if (isset($_GET["error"])) {
                if (($_GET["error"]) == "emptyInput") {
                    echo "<script>alert('Fill in all fields!')</script>";
                }
                else if (($_GET["error"]) == "invalidEmail") {
                    echo "<script>alert('Choose a proper email!')</script>";
                }
                else if (($_GET["error"]) == "passworddontMatch") {
                    echo "<script>alert('Password doesn't Match!')</script>";
                }
                else if (($_GET["error"]) == "emaildoesntExit") {
                    echo "<script>alert('E-mail already taken!')</script>";
                }
                else if (($_GET["error"]) == "stmt_prepare_failed") {
                    echo "<script>alert('Something went wrong, Please try again!')</script>";
                }
                else if (($_GET["error"]) == "none") {
                    echo "<script>alert('You have signed up!')</script>";
                }
                else {
                    echo "";
                }
            }
        ?>
    </div>
</body>
</html>