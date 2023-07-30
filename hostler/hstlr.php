<?php
//Shows the current menu and the menu of the week for the hosteler

    session_start();
    include("connection.php");
    include("functions.php");

    $number = $_SESSION['number'];

     $query = "select * from hostler where number = '$number' ";
     $result1 = mysqli_query($con,$query);
     $id1 = mysqli_fetch_array($result1);
     $id = $id1['hstl'];

    $today = getdate(); //Used to get today's date. Used in showing the menu of the day
    $daynum =(int) $today['wday'];
    $daynum = $daynum - 1;//Storing the index of the day, to retrieve the day from days array

    

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
    /* The image used */
    background-image: url("food.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
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
                <li class="nav-item active">
                  <a class="nav-link" href="hstlr.php">Today's Special<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="fee.php">Fee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
              </ul>
            </div>
          </nav>
          
            <div class="bg" >
          <div class="card border-success" style="opacity:0.9; background:transparent;">
                <div class="card-header bg-primary text-white">

                <!--Shows Menu of the respective day-->


                    <h1><b>Today's Menu</b></h1>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped table-bordered table-responsive-sm bg-primary">
                        <thead>
                        <tr style="color:rgb(255, 255, 255)" class = "bg-info">
                            <th scope="col">Day</th>
                            <th scope="col">Breakfast</th>
                            <th scope="col">Lunch</th>
                            <th scope="col">Dinner</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                                $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                                $query2 = "select bf,lunch,dinner from `$id`";
                                $result = mysqli_query($con,$query2);
                                $i=0;


                                //The main code to show display the current menu of the day


                                while($row = mysqli_fetch_array($result)){
                                    if($row['bf'] != NULL){
                                        if($daynum == $i){
                                            echo "<td style='color:rgb(255, 255, 255)'><b>". $days[$i]."</b></td>";
                                            
                                            echo "<td><b>". $row['bf']."</b></td>";
                                            
                                            echo "<td><b>". $row['lunch']."</b></td>";
                                            echo "<td><b>". $row['dinner']."</b></td>";
                                        }
                                        $i++;
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
          <div class="card border-success" style=" background:transparent;">
          <!-- Regular menu from here -->
                <div class="card-header bg-primary text-white">
                    <h1><b>Regular Menu</b></h1>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped table-bordered table-responsive-sm bg-primary">
                        <thead>
                        <tr style="color:rgb(255, 255,255)" class = "bg-info">
                            <th scope="col">Day</th>
                            <th scope="col">Breakfast</th>
                            <th scope="col">Lunch</th>
                            <th scope="col">Dinner</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                            $query4 = "select bf,lunch,dinner from `$id`";
                            $result = mysqli_query($con,$query4);
                            $i=(int)0;
                            
                            while($row = mysqli_fetch_array($result)){
                                if($row['bf'] != NULL){
                                    echo "<tr><td style='color:rgb(255, 255, 255)'><b>".$days[$i]."</b></td>";
                                    echo "<td><b>".$row['bf']."</b></td>";
                                    echo "<td><b>".$row['lunch']."</b></td>";
                                    echo "<td><b>".$row['dinner']."</b></td></tr>";
                                     $i++;
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            <div class="card-footer align-center">
                <h4> <a href="../index.php">Logout</a></h4>
            </div>
        </div></div>
    </body>
</html>