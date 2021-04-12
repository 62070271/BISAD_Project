<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Datepicka_Fong.S.W/jquery.min.js"></script>
    <script src="Datepicka_Fong.S.W/node_modules/jquery/dist/jquery.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.js"></script>
    <script src="Datepicka_Fong.S.W/lib/picker.date.js"></script>
    <script src="Datepicka_Fong.S.W/lib/legacy.js"></script>
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.date.css">
    <link rel="stylesheet" href="Datepicka_Fong.S.W/lib/themes/classic.time.css">
    <style>

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

    <div style="text-align: center;">
        <h2>Home Page</h2>
        <?php
            if (isset($_SESSION['email'])) {
                echo "<h4>Welcome: " . $_SESSION['email'] . "</h4>";
                echo "<h4>Welcome: " . $_SESSION['user_name'] . "</h4>";

                echo "<br>";
                echo '<h3><a href="index.php?logout=1" style="color: red;">Log Out</a></h3>';
                echo "<br>";
                echo '<h3><a href="Editprofile.php" style="color: blue;">Editprofile</a></h3>';
            }
            if (isset($_SESSION['success'])) {
                echo "<h4>Welcome: " . $_SESSION['success'] . "</h4>";
                unset($_SESSION['success']);
            }
            else if (!isset($_SESSION['email'])){
                echo "<h3><a style='color: red;' href='logIn_front.php'>Log in</a></h3>";
            }
        ?>
        
        <form>
            <h2>Dropdowns for Month and Year</h2>
            <label for="datepicker">Enter Date</label>
            <input  class="datepicker" name="date_1" id="date_1" aria-owns="date_1_root" aria-hidden='false'>

        </form>
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
    </div>

    
    

</body>

</html>