<?php
//Shows the profile of the hosteler
    session_start();

    include("connection.php");
    $number = $_SESSION['number'];
   

    $query = "select * from hostler where number = '$number'";
    $res = mysqli_query($con,$query);
    
    $row = mysqli_fetch_array($res);
   

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hostel Managment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
        body {font-family: "Times New Roman", Georgia, Serif; }
        h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
        opacity:"1";
        
        }

    .bg {
    background-image: url("profile.png");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    box{
        background-color:white;
        padding:5px;
        border-radius:10px;
    }
 </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light c">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="hstlr.php">Today's Special</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="fee.php">Fee</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>
          <div class="bg">
          
        <form>
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b> <?php echo $row['name']; ?></b></h1>
             </div>
             <div class="card-body">
 <pre><b><div class="form-group"  style=" color:rgb(0, 0, 0); font-size:large;">
Number      :<box><?php echo $number; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Password    : <box><?php echo $row['password']; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Room        : <box><?php echo $row['room']; ?></box> </div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Fee         : <box><?php echo $row['fee']; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Joining date: <box><?php echo $row['doj']; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Next Date   : <box><?php echo $row['nxtdate']; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Address     : <box><?php echo $row['address']; ?></box></div><div class="form-group" style=" color:rgb(0, 0, 0); font-size:large;">
Aadhaar     : <?php
                        if($row['aadhaar']){
                            echo $row['aadhaar']; 
                        } else {
                            echo "Not given";
                        }
                     ?></b>   </pre>
                </div>
         
            </div>
                <div class="card-footer align-center">
                  <h4><button> <a href="../index.php">Logout</a></button></h4>
                </div>
            
        </div>
    </div>
    </form>
    </div>
    </body>
    </html>