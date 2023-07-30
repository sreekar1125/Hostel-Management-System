<?php
    session_start();
    //Shows the profile page of the Owner
    include('connection.php');
    
    $id = $_SESSION['user_id'];
    $number = $_SESSION['number'];

    $query = "SELECT * FROM `$id` WHERE number = '$number'";
    $query3 = "SELECT * FROM owner WHERE number = '$number' ";

    //echo $query;
    $res = mysqli_query($con,$query);
    $row = mysqli_fetch_array($res);
    //ID table does not hold the values of room left, hence going for two queries with one query fetching records from ID table and the other from owner table
    $res3 = mysqli_query($con,$query3);
    $row3 = mysqli_fetch_array($res3);

    $name =$row['ownName'];
    $mail =$row['mail'];
    $hstlName =$row['hstlName'];
    $address =$row['address'];
    $totRoom = $row['room'];
    $password = $row3['password'];
    $roomLeft = $row3['roomLeft'];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    //To update the values of Number, Password and remaining rooms respectively
    { 
        $newnum = $_POST['number'];
        $newpass = $_POST['password'];
        $newroom = $_POST['roomLeft'];
        if($newnum != NULL){
            $query1 = "update `$id` set number = '$newnum' where number = '$number' ";
            mysqli_query($con,$query1);
            $query2 = "update owner set number = '$newnum' where number = '$number' ";
            mysqli_query($con,$query2);
            $_SESSION['number'] = $newnum;
            $number = $newnum;
        }
        if($newpass != NULL){
            $query2 = "update owner set  password = '$newpass' where number = '$number' ";
            mysqli_query($con,$query2);
            $password = $newpass;
        }
        if($newroom != NULL){
            $query2 = "update owner set  roomLeft = '$newroom' where number = '$number' ";
            mysqli_query($con,$query2);
            $roomLeft = $newroom;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
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
                  <a class="nav-link" href="calci.php">Calculations</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="menu.php">Menu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hstlrs.php">Hostlers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>

            <div class="bg" >
         <form method="POST">
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Profile</b></h1>
             </div><h4>
            <div class="card-body">

              <pre>  <div class="form-group " >
OWNER NAME  : <box><?php echo $name ?></box> <br><br>
EMAIL       : <box><?php echo $mail ?></box><br><br>
HOSTEL NAME : <box><?php echo $hstlName ?></box><br><br>
ADDRESS     : <box><?php echo $address ?></box><br><br>
Total Rooms : <box><?php echo $totRoom ?></box><br></pre>
                    
                </div>
            <!--Code to update the number in owner profile-->
            <div class="form-group "  style="padding-left:20px;padding-right:20px;">
                    <label for="number" >Number</label>
                    <input type="number" class="form-control border-success" placeholder=<?php echo $number ?> name="number" >
                    <button type="submit" class="btn btn-primary" id="Update">Update</button>
            </div>
            <!-- code to update the password for owner profile -->
            <div class="form-group "  style="padding-left:20px;padding-right:20px;">
                    <label for="number" >Password</label> 
                    <input type="text" class="form-control border-success" placeholder=<?php echo $password ?> name="password" >
                    <button type="submit" class="btn btn-primary" id="Update">Update</button>
            </div>
            <!--Update the number of rooms available -->
            <div class="form-group "  style="padding-left:20px;padding-right:20px;">
                    <label for="number" >Rooms Available</label> 
                    <input type="text" class="form-control border-success" placeholder=<?php echo $roomLeft ?> name="roomLeft" >
                    <button type="submit" class="btn btn-primary" id="Update">Update</button>
            </div>

            </div></h4>
 <div class="card-footer align-center">
                   <h4><button> <a href="../index.php">Logout</a> </button> </h4>
                </div>
</div>

          </body>
          </html>