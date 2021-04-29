<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Slip</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- Font Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!-- Font Rammetto -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("Location: logIn_front.php");
    }
    ?>

    <style>
        body {
            background-image: url('https://images.pexels.com/photos/1633746/pexels-photo-1633746.jpeg?cs=srgb&dl=pexels-bezalel-thilojan-1633746.jpg&fm=jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
        }

        .rammeto {
            font-family: 'Rammetto One', cursive;
        }

        .kanit {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #395902;">
        <div class="container">
            <a class="navbar-brand rammeto" href="index.php">
                <img src="images/20210413885810631.jpg" alt="" width=" 30" height="30" class="d-inline-block align-text-top border border-white rounded-circle ">
                ZOO
            </a>
            <?php
            if (isset($_SESSION['email'])) {
            ?>
                <!-- dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FBB03B;"><img src='user_images/<?php echo $_SESSION["user_image"] ?>' alt='' width='30' height='30' class='d-inline-block align-text-top border border-dark rounded-circle'>&nbsp<?php echo $_SESSION['user_name']; ?></a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Profile&QR_Code.php">Profile & QR Code</a></li>
                        <li><a class="dropdown-item" href="Editprofile.php">Edit profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php?logout=1">Log out</a></li>
                    </ul>
                </div>
            <?php
            } else if (!isset($_SESSION['email'])) {
            ?>
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
            <?php
            }
            ?>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center rammeto" style="color: #fbb03b;">UPLOAD PAYMENT</h1>
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top w-75 mx-auto mt-3" id="previewImg" src="https://workwiththebest.intraway.com/wp-content/uploads/sites/4/2016/10/upload-1118929_960_720.png">
                    <div class="card-body">
                        <h5 class="card-title text-center rammeto">Upload Your Picture</h5>
                        <hr>
                        <form action="uploadslip_back.php" method="post" enctype="multipart/form-data">
                            <p>Select image to upload:</p>
                            <input class="form-control" onchange="previewFile(this)" type="file" name="pic" id="pic" require accept="image/*" required><br><br>
                            <div class="text-center rammeto">
                                <button onclick="changepic()" class="btn btn-primary text-light btn-right" type="submit" value="Upload" name="submit">Submit Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>