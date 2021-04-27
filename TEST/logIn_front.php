<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <title>Log in</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* .show_calendar {
            display: none;
        } */

        body {
            top: 1000px;
            background-image: url(Web_Image/lion-width4000__heal.png);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }

        #imge {
            object-fit: none;
            display: inline-block;
            overflow: hidden;
            position: relative;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .homepage_name {
            font-family: 'Rammetto One', cursive;
        }
    </style>
</head>

<body>
    <div class="container" style="font-family: 'Kanit', sans-serif;">
        <div class='row'>
            <div class='col-2'></div>
            <div class='col-8'>
                <div class='row mt-5'>
                    <div class="card pt-0 pb-1 mb-7" style="width: 100%; height: 35vw; padding: 12px; min-height: 625px;">
                        <div class="row">
                            <div class="card-img-left m-0 p-0 col-4">
                                <img id='imge' style="width:270px;height: 34.9vw; min-height: 622.5px;" src="https://images.pexels.com/photos/6249428/pexels-photo-6249428.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="sans" />
                            </div>
                            <div class="col-8">

                                <div class="card-body " style='vertical-align: middle;'>
                                    <img src="images/20210413885810631.jpg" alt="" width="125" height="125" class="center img-thumbnail border border-white rounded-circle">
                                    <form action="logIn_back.php" method="POST" onsubmit="" name="logIn">
                                        <h2 class='my-2'>Log In</h2>
                                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                                        <br><br>
                                        <input type="password" class="form-control" name='password' placeholder="Password">
                                        <br><br>
                                        <button type="submit" class="btn btn-success" name="submit" style="float: right;">Log In!</button>
                                    </form>
                                    <br>
                                    <br>
                                    <h5 class="form-label m-2 mt-4">Create your account. <a href="reg_front.php"><button type="button" class="btn btn-success">Sign Up!</button></a></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class='col-2'></div>
            </div>
        </div>
        <?php
        if (isset($_GET["error"])) {
            if (($_GET["error"]) == "Wrongemailorpassword!") {
                echo "<script>alert('Wrong email or password')</script>";
            }
            if (($_GET["error"]) == "emty_input_login") {
                echo "<script>alert('Please input  email and password for login')</script>";
            }
        }
        ?>
</body>

</html>