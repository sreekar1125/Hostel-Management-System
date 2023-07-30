<?php
//display a simple HTML page which shows the details of the hostel and the fee details of the hosteler.
    session_start();

    include("connection.php");
    $number = $_SESSION['number'];
   

    $query = "select * from hostler where number = '$number'";
    $res = mysqli_query($con,$query);
    
    $row = mysqli_fetch_array($res);
   
    $query = "select * from hostler where number = '$number' ";
     $result1 = mysqli_query($con,$query);
     $id1 = mysqli_fetch_array($result1);
     $id = $id1['hstl'];

     $query2 = "select * from `$id`";
     $result2 = mysqli_query($con,$query2);
     $email = mysqli_fetch_array($result2);
     $mail = $email['mail'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hostel Managment</title>
       
        <style>
        body {font-family: "Times New Roman", Georgia, Serif; }
        h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
        opacity:"1";
        
        }

    .bg {
    /* The image used */
    background-image: url("mon.jpg");

    /* Full height */
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

    }

    div{
        font-weight:bolder;
    }

 </style>

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light c ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="hstlr.php">Today's Special</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="fee.php">Fee<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
              </ul>
            </div>
          </nav>

        <div class="bg" >

        <form>
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b> <?php echo $row['name']; ?></b></h1>
            </div>
            <div class="card-body" style="color:rgb(255, 255,255); font-size:30px;">
                <div class="form-group">
                    FEE       : <?php echo $row['fee']; ?>
                </div>
                <div class="form-group">
                    NEXT DATE : <?php echo $row['nxtdate']; ?>
                </div>
            </div>
        </div></div>
        </form>

        <form>
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b> <?php echo $email['hstlName']; ?></b></h1>
            </div>
            <div class="card-body" style="color:rgb(255, 255, 255); font-size:30px;"><!-- Displays the owner details in the hosteler fee page -->
                <div class="form-group">
                    OWNER      : <?php echo $email['ownName']; ?>
                </div>
                <div class="form-group">
                    EMAIL      : <?php echo $email['mail']; ?>
                </div>
                <div class="form-group">
                    ADDRESS    : <?php echo $email['address']; ?>
                </div>
                <div class="form-group">
                    <?php echo "<button> <a href='mailto:$mail' target='_blank'>Send Complaint</a> </button>" ?>
                </div>
                </div>
            </div>
            <div class="card-footer align-center">
                  <h4><button> <a href="../index.php">Logout</a></button> </h4>
            </div>
        </div>
        </div>
        </form>

               </div> 
            
        </div>
        </div>
    </body>
    </html>