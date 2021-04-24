<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Account Summary</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/33045/lion-wild-africa-african.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1>Daily Account Summary</h1>
        <hr>
        <div class="row text-center"> 
            <div class="col-md-4">
                <h6>Number of bookings per day</h6>
                <h2>00998</h2>
            </div>
            <div class="col-md-4">
                <h6>Number of people per day</h6>
                <h2>01400</h2>
            </div>
            <div class="col-md-4">
                <h6>booking income</h6>
                <h2>0100000</h2>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-12">
                <form action="Summary_back.php" method="POST">
                    <div class="card">
                        <div class="row mx-3 mt-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5>Today's customer booking list</h5>
                                    </div>
                                    <div class="col-md-2">
                                        
                                    </div>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-50" scope="col">Number of type card</th>
                                            <th class="w-25 text-center" scope="col">Number of people</th>
                                            <th class="w-25 text-center" scope="col">Booking price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">เด็กไทย</th>
                                            <td class="text-center">150</td>
                                            <td class="text-center">100000</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">ผู้ใหญ่ไทย</th>
                                            <td class="text-center">200</td>
                                            <td class="text-center">100000</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">เด็กต่างชาติ</th>
                                            <td class="text-center">20</td>
                                            <td class="text-center">100000</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">ผู้ใหญ่ต่างชาติ</th>
                                            <td class="text-center">40</td>
                                            <td class="text-center">100000</td>

                                        </tr>
                                    </tbody>
                                </table>
                                <h6 class="pl-2 pb-2">Number of Search Results : 998</h6>
                                <div class="row pb-3">
                                    <button type="submit" class="btn btn-success ">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                    <h1>1</h1>
                </form>
            </div>
        </div>
    </div>
</body>

</html>