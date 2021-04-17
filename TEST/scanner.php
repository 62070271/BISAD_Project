<!DOCTYPE html>
<html>
<head>
	<title>Verify QR-code</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Instacan -->
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12 text-center">
                <h1 class="text-center py-3">Check QR Code</h1>
                <div>
                <center><video style="width: 20%;" id="preview"></video></center>
                <p id="pscan" class="alert text-danger">Please Scan!</p>
                <h4 class="text-center">SCAN QR CODE</h4>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary rounded-circle" data-toggle="modal" data-target="#exampleModal">
                  <svg class="d-block" xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                  </svg>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form method="POST">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-left mx-3">
                          <h5>Confirm ID : <input type="text" id="saccount" name="saccount" style="border:none;"></h5>
                          <h5>Firstname : <span id="sfirstname"></span></h5>
                          <h5>Lastname : <span id="slastname"></span></h5>
                          <h5>Booking Date : <span id="sbook"></span></h5>
                          <h5>Quantity Order : <span id="squan"></span></h5>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Unaccept</button>
                          <button type="submit" name="btaccept" class="btn btn-primary">Accept</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div><br>
                <p>
                  <?php
                    include('server.php');

                    // sql to update a record
                    if (isset($_POST['btaccept'])){
                        $accidsql = intval(mysqli_real_escape_string($connection, $_POST['saccount']));
                        $tkstatus = "SELECT qrcode_status FROM QR_CODE WHERE confirm_id=$accidsql";
                        $querystatus = mysqli_query($connection, $tkstatus);
                        $fetquestatus = mysqli_fetch_assoc($querystatus);

                        if (mysqli_num_rows($querystatus) == 1){
                          if ($fetquestatus['qrcode_status'] == '1'){
                            $sql = "UPDATE QR_CODE SET qrcode_status='0' WHERE confirm_id=$accidsql";
                            mysqli_query($connection, $sql);
                            echo "<script>";
                            echo "alert('Use QR-code success!');";
                            echo "</script>"; 
                            
                          }else{
                            echo "<script>";
                            echo "alert('This QR-Code has been used!');";
                            echo "</script>";
                            
                            // echo "<script>";
                            // echo "alert(".$querystatus.");";
                            // echo "</script>";  
                          };
                        }else{
                          echo "<script>";
                          echo "alert('QR-code not found!');";
                          echo "</script>";  
                        }

                        // if ($connection->query($sql) === TRUE) {
                        //   echo "Record deleted successfully";
                        // } else {
                        //   echo "Error deleting record: " . $connection->error;
                        // }
                    }
                    mysqli_close($connection);
                  ?>
                </p>
            </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var txt = "";
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

      scanner.addListener('scan', function (content) {
        // document.getElementById("pscan").innerHTML = content;

        spldata = content.split(",");
        document.getElementById("saccount").value = spldata[0];
        document.getElementById("sfirstname").innerHTML = spldata[1];
        document.getElementById("slastname").innerHTML = spldata[2];
        document.getElementById("sbook").innerHTML = spldata[3];
        document.getElementById("squan").innerHTML = spldata[4];

        document.getElementById("pscan").innerHTML = '<p class="alert text-success">Scan Success!</p>';

        // set timeout 3 secord
        setTimeout(function() {
          document.getElementById("pscan").innerHTML = "Please Scan!";
        }, 3000);

      });

      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            
            // 0 open the front camera
            // 1 open the back camera
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
      
    </script>
</body>
</html>