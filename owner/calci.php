<?php
//Shows the calcuation part.
    session_start();
    
    include('connection.php');

    $id = $_SESSION['user_id'];
    $number = $_SESSION['number'];
    $query = "SELECT * FROM `$id` WHERE number = '$number'";
    //fetches the details of the owner
    
    $res = mysqli_query($con,$query);
    $row = mysqli_fetch_array($res);//stores the details in the form of rows
    $totalMoney =(int)$row['totalMoney'];
        //calculation to show total money
        $earn =(int)$_POST['earn'];
        $spent =-1 * (int)$_POST['spent'];
        $desE = $_POST['desE'];//desc for money earned
        $desS = $_POST['desS'];

        $totalMoney = $totalMoney + $earn + $spent;
        //updating the values based on various combinations of money earned and spent
        if($earn != NULL){
            if($spent != NULL){
                $query3 = "INSERT INTO `$id`(money,description) values ('$spent','$desS') ";
                mysqli_query($con,$query3);
            }
            //Update the owner table to include the new values of money spent and money earned
            $query1 = "UPDATE `$id` SET totalMoney = '$totalMoney'  WHERE number = '$number' ";
            $query2 = "INSERT INTO `$id`(money,description) values ('$earn','$desE') ";
            mysqli_query($con,$query1);
            mysqli_query($con,$query2);

        } else if($spent != NULL){

            $query3 = "INSERT INTO `$id`(money,description) values ('$spent','$desS') ";
            $query1 = "UPDATE `$id` SET totalMoney = '$totalMoney' WHERE number = '$number'";
            mysqli_query($con,$query3);
            mysqli_query($con,$query1);
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
    background-image: url("money.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
 </style>

        <!-- CSS -->
       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        
    </head>
    <body>
    <!--Navbar code(recurring) -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="calci.php">Calculations</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="menu.php">Menu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hstlrs.php">Hostlers</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>



<div class="bg" >

             <form method="POST" >
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Calculations</b></h1>
             </div>
             
            <div class="card-body" >
                <div class="form-group">
                    <?php 
                    if($totalMoney > 0){
                        echo "<h4 style='color:rgb(0, 204, 0);'><b>Current Status = '".$totalMoney."'Rs PROFIT";
                     }
                     else {
                         echo "<h4 style='color:rgb(255, 0, 0);'><b>Current Status = '".$totalMoney."'Rs  In LOSS";
                     }
                    ?>
                  </b>  </h4>
                </div>
                <!--Displays the HTML boxes for amount entered and amount spent -->
                <div class="form-group " >
                    <input type="number" class="form-control border-success" placeholder="Amount Earned" name="earn" ><br>
                    <input type="text" class="form-control border-success" placeholder="Description" name="desE" >
                </div>
                <div class="form-group">
                    <input type="number" class="form-control border-danger" placeholder="Amount Spent" name="spent" ><br>
                    <input type="text" class="form-control border-danger" placeholder="Description" name="desS" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
                <div>
                    
                </div>
            </div>
               
        </div>
    </div>
    </form>
        <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>HISTORY</b></h1>
             </div>
             
            <div class="card-body" >
    <!-- Displays the transaction history -->
                    <table class="table table-hover table-striped table-bordered table-responsive-sm">
                        <thead  class="card-header bg-primary text-white">
                        <tr style="color:rgb(255, 255, 255);">
                            <th scope="col">AMOUNT</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">DATE</th>
                        </tr>
                        </thead>
                        <tbody class=" bg-info text-white">
                        <?php
                            //code for transaction history
                            $query4 = "select money, description,ts from `$id`";
                            $result = mysqli_query($con,$query4);
                            while($row = mysqli_fetch_array($result)){
                                if($row['money'] != NULL){
                                    $money =(int)$row['money'];
                                    if($money > 0){
                                        echo "<tr style = 'color:darkgreen';font-weight:bolder>";
                                    } else{
                                        echo "<tr style = 'color:darkred'>";
                                    }
                                echo "<b><td><b>".$row['money']."</td></b>";
                                echo "<td><b>".$row['description']."</b></td>";
                                echo "<td><b>".$row['ts']."</td></b></tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                    </div> 
                    <div class="card-footer align-center">
                   <h4><button> <a href="../index.php">Logout</a></button> </h4>
                </div>
            
</div>
    </body>
</html>
         