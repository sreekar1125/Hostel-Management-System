<?php
//This page shows the original menu and contains the code to update the menu when required.
    session_start();

    include("connection.php");
    $id = $_SESSION['user_id'];

    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id = $_SESSION['user_id'];
        $number = $_SESSION['number'];
        $monB = $_POST['monB']; 
        //Updates the menu in accordance with values entered after the update menu option is hit.
        $monL = $_POST['monL'];
         //Here 'B' stands for breakfast, l stands for lunch and D for dinner respectively.
        $monD = $_POST['monD']; 
        $tueB = $_POST['tueB']; 
        $tueL = $_POST['tueL']; 
        $tueD = $_POST['tueD']; 
        $wedB = $_POST['wedB']; 
        $wedL = $_POST['wedL']; 
        $wedD = $_POST['wedD']; 
        $thuB = $_POST['thuB']; 
        $thuL = $_POST['thuL']; 
        $thuD = $_POST['thuD']; 
        $friB = $_POST['friB']; 
        $friL = $_POST['friL']; 
        $friD = $_POST['friD']; 
        $satB = $_POST['satB']; 
        $satL = $_POST['satL']; 
        $satD = $_POST['satD']; 
        $sunB = $_POST['sunB']; 
        $sunL = $_POST['sunL']; 
        $sunD = $_POST['sunD']; 

        $bf = array($monB,$tueB,$wedB,$thuB,$friB,$satB,$sunB);
        $lunch = array($monL,$tueL,$wedL,$thuL,$friL,$satL,$sunL);
        $dinner = array($monD,$tueD,$wedD,$thuD,$friD,$satD,$sunD);

        $drop = "update `$id` set lunch = NULL,dinner = NULL,bf=NULL";#Had to update the previous values as NULL to prevent overlapping of tables
        mysqli_query($con,$drop);
        
        #inserting the user input values into the database iteratively.
        for($i = 0; $i < 7; $i++){
        $query = "insert into `$id`(bf,lunch, dinner) values ('$bf[$i]','$lunch[$i]', '$dinner[$i]')";
        mysqli_query($con ,$query);
       }
    }

  ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hostel Managment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <style>
        body {font-family: "Times New Roman", Georgia, Serif; }
        h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
        opacity:"1";
        }

    .bg {
    /* The image used */
    background-image: url("kit.jpeg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
 </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="calci.php">Calculations</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="menu.php">Menu<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hstlrs.php">Hostlers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
              </ul>
            </div>
          </nav>

          <div class="bg" >
            <div id="a" style="visibility: visible;">
            <div class="container-fluid">
            <div class="card border-success"  style="opacity:0.9; background:transparent;">
                <div class="card-header bg-primary text-white">
                    <h1><b>Menu</b></h1>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped table-bordered table-responsive-sm">
                        <thead>
                        <tr style="color:rgb(0, 102, 0)" class=' bg-primary text-white'>
                            <th scope="col">Day</th>
                            <th scope="col">Breakfast</th>
                            <th scope="col">Lunch</th>
                            <th scope="col">Dinner</th>
                        </tr>
                        </thead>
                        <tbody class=' bg-info text-white'>
                       
                        <?php
                        //Used to display the menu items before the update button is hit
                            $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                            $query4 = "select bf,lunch,dinner from `$id`";
                            $result = mysqli_query($con,$query4);
                            $i=0;
                            
                            while($row = mysqli_fetch_array($result)){
                                if($row['bf'] != NULL){
                                    //display the menu items for each day of the week
                                    echo "<tr><td class=' bg-info text-white' style='color:rgb(0, 255, 255)'><b>".$days[$i]."</b></td>";
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

                    <button onclick="visible()"> Update Menu</button>
                    <!--Hide the original table and show the new table after update table button is hit-->
</div>


                </div>
                </div>






<!--Display the new table-->
<div id="b" style="display: none;">

                 <form method="POST" >

         <section class="form-08" style="overflow: scroll;">
      <div class="container-fluid" style="opacity:0.9">
        <div class="row">
          <table class="table table-hover table-striped table-bordered table-responsive-sm">
            <thead>
              <tr style="color:rgb(0, 102, 0)" class=' bg-primary text-white'>
                <th scope="col">Day</th>
                <th scope="col">BreakFast</th>
                <th scope="col">Lunch</th>
                <th scope="col">Dinner</th>
              </tr>
            </thead>
            <tbody class=' bg-info text-white'>
              <tr>
            <!-- Enter the new values after the update menu option is hit. This code contains the html table to enter new values-->
            
                <th scope="row">Monday</th>
                <td><input type="text" class="form-control" name = "monB" required></td>
                <td><input type="text" class="form-control" name = "monL" required></td>
                <td><input type="text" class="form-control" name = "monD" required></td>           
              </tr>
              <tr>
                <th scope="row">Tuesday</th>
                <td><input type="text" class="form-control" name = "tueB" required></td>
                <td><input type="text" class="form-control" name = "tueL" required></td>
                <td><input type="text" class="form-control" name = "tueD" required></td>
              </tr>
              <tr>
                <th scope="row">Wednesday</th>
                <td><input type="text" class="form-control" name = "wedB" required></td>
                <td><input type="text" class="form-control" name = "wedL" required></td>
                <td><input type="text" class="form-control" name = "wedD" required></td>
              </tr>
              <tr>
                <th scope="row">Thursday</th>
                <td><input type="text" class="form-control" name = "thuB" required></td>
                <td><input type="text" class="form-control" name = "thuL" required></td>
                <td><input type="text" class="form-control" name = "thuD" required></td>
              </tr>
              <tr>
                <th scope="row">Friday</th>
                <td><input type="text" class="form-control" name = "friB" required></td>
                <td><input type="text" class="form-control" name = "friL" required></td>
                <td><input type="text" class="form-control" name = "friD" required></td>
              </tr>
              <tr>
                <th scope="row">Saturday</th>
                <td><input type="text" class="form-control" name = "satB" required></td>
                <td><input type="text" class="form-control" name = "satL" required></td>
                <td><input type="text" class="form-control" name = "satD" required></td>
              </tr>
              <tr>
                <th scope="row">Sunday</th>
                <td><input type="text" class="form-control" name = "sunB" required></td>
                <td><input type="text" class="form-control" name = "sunL" required></td>
                <td><input type="text" class="form-control" name = "sunD" required></td>
              </tr>
            </tbody>
          </table>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
                
            </div>
             
        </div>
    </form>

    
                </div>
          <div class="card-footer align-center">
                   <h4><button> <a href="../index.php">Logout</a></button></h4>
                </div>
                </div>
</div>

</div>

                 </div>
            <!--Hide the previous table when the update MENU option is clicked -->
                 <script>
                    function visible(){
                        document.getElementById("a").style.display = "none";
                        document.getElementById("b").style.display = "block";
                    }
                 </script>

          </body>
          </html>