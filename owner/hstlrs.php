<?php
    //page to add hostelers
    session_start();
    
    include("connection.php");

    $number = $_SESSION['number'];
    $id = $_SESSION['user_id'];

   if(isset($_POST['create'])) //When hosteler fields are entered and created
    {
        $name = $_POST['name'];
        $hsnumber = $_POST['number'];
        $password = $_POST['password'];
        $aadhaar = $_POST['aadhaar'];
        $room = $_POST['room'];
        $fee = $_POST['fee'];
        $address = $_POST['address'];
        $doj = $_POST['doj'];
        $nxtdate = $_POST['nxtdate'];
        $status = 1;


        $query = "insert into hostler( name, number, password, aadhaar, room, fee, doj, nxtdate, address, hstl,status) values ('$name',                '$hsnumber', '$password', '$aadhaar', '$room', '$fee','$doj','$nxtdate','$address','$id','$status')"; 
        mysqli_query($con,$query);//insert into hosteler table


     } 
    //To update hosteler next fee payment date
    if($_POST['action'] && $_POST['number'] ){
        if($_POST['action'] == 'update1' ){

            $newdate = $_POST['newDate'];
                $ccnum = $_POST['number'];
                $query3 = "update hostler set nxtdate = '$newdate' where number = '$ccnum' ";
               // echo $query3;
                mysqli_query($con,$query3);
                $nxtdate = $newdate;

                $query5 = " select * from hostler where number = '$ccnum' ";
                $res = mysqli_query($con,$query5);
                $row = mysqli_fetch_array($res);
                $name = $row['name'];
                $fees =(int) $row['fee'];
                $des = "Fee ".$name."";

                $query4 = " insert into `$id`(money,description) values('$fees','$des') ";
                mysqli_query($con,$query4);


                
                $query9 = " select totalMoney from `$id` where number = '$number' ";
                $res1 = mysqli_query($con,$query9);
                $row1 = mysqli_fetch_array($res1);
                $totalMoney =(int)$row1['totalMoney'];
                
                
                $totalMoney = $totalMoney + $fees;

                $query7 = "UPDATE `$id` SET totalMoney = '$totalMoney'  WHERE number = '$number' ";
                mysqli_query($con,$query7);
        }
        //Delete hosteler record
        if($_POST['action'] == 'del' ){
            $num = $_POST['number'];
            $query8 = " delete from hostler where number = '$num' ";
            mysqli_query($con,$query8);
        }
    }

   if($_POST['accept'] && $_POST['number'] ){
       //Accept or reject hostel applications in the applications table
       $ccnum = $_POST['number'];
       $room = $_POST['room'];
       $fee = $_POST['fee'];
       $doj = $_POST['doj'];
       $nxtdate = $_POST['nxtdate'];
       $status = 1;
       $query3 = "update hostler set room = '$room', fee = '$fee', doj = '$doj', nxtdate = '$nxtdate' ,status = '$status' where number = '$ccnum' ";
    mysqli_query($con,$query3);
   }

   if($_POST['reject'] && $_POST['number'] ){
       $ccnum = $_POST['number'];
        $status = 0;
        $query3 = "update hostler set status = '$status' where number = '$ccnum' ";
        mysqli_query($con,$query3);
   }
    

?>

<!DOCTYPE html>
<html>
    <head>
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
    background-image: url("hstl.jpg");

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
                <li class="nav-item active">
                  <a class="nav-link" href="hstlrs.php">Hostlers</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>

 <div class="bg" >
             <div class="container-fluid">
        <div class="card" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Add Hostler</b></h1>
             </div>
                <form method="POST"  >
            <!--HTML for entering hostelers -->
            <div class="card-body">
                    <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="nubmber" class="form-control" name="number" placeholder="Number" minlength="10" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="password" minlength="8" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="aadhaar" placeholder="Aadhaar" minlength="12">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="room" placeholder="Room" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="fee" placeholder="Fee" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>Date of Joining
                <div class="form-group">
                    <input type="date" class="form-control" name="doj" required>
                </div>Next Fee Payment Date
                <div class="form-group">
                    <input type="date" class="form-control" name="nxtdate"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit" name="create" value="create">Submit</button>
                </div>
                
            </div></form>

        <!--HTML for showing currently enrolled hostelers -->
         <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Hostler</b></h1>
             </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                    <tr style="color:rgb(255, 255, 0)" class=" bg-primary text-white" >
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Aadhaar</th>
                        <th scope="col">Fee Date</th>
                        <th scope="col">If Fee Paid</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody  class=" bg-info text-white">
                        <!-- current hostelers -->
                        <?php 
                            $status = 1;
                            $query2 = "select * from hostler where hstl = '$id'  AND status = '$status' ";
                            $res = mysqli_query($con,$query2);
                            while( $row = mysqli_fetch_array($res)){
                                echo "<tr><td>".$row['name']."</td>";
                                echo "<td>".$row['number']."</td>";
                                echo "<td>".$row['aadhaar']."</td>";
                                echo "<td>".$row['nxtdate']."</td>";
                                echo " <form method='POST'> ";
                                echo "<td> Next date : <input type='date' name='newDate'> 
                                    <button type='submit'  name='action' value='update1'>Update</button></td>";
                                echo " <td> <button type='submit' name='action' value='del'> Delete </button></td> ";
                                echo "<input type='hidden' name='number' value='".$row['number']."'> ";
                                echo "</tr></form>";
                            }
                        ?>

                    </tbody>
                </table>
            </div>
</div>

</div>
 <div class="container-fluid">
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Applications</b></h1>
             </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                    <tr style="color:rgb(255, 255, 0)" class=" bg-primary text-white" >
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Allot Room</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Date of joining</th>
                        <th scope="col">Next payment date</th>
                        <th scope="col">Accept</th>
                        <th scope="col">Reject</th>
                    </tr>
                    </thead>
                    <tbody  class=" bg-info text-white">
                        
                        <?php 
                        //Show the Applications in the application table
                            $status = 2;
                            $query3 = "select * from hostler where hstl = '$id' AND status = '$status' ";
                            $res = mysqli_query($con,$query3);
                            while( $row = mysqli_fetch_array($res)){
                                echo "<tr><td>".$row['name']."</td>";
                                echo "<td>".$row['number']."</td>";
                                echo " <form method='POST'> ";
                                echo " <td> <input type='text' name='room'  required>  </td> ";
                                echo " <td> <input type='number' name='fee'  required>  </td> ";
                                echo " <td> <input type='date' name='doj'  required>  </td> ";
                                echo " <td> <input type='date' name='nxtdate'  required>  </td> ";
                                echo " <td> <button type='submit' name='accept' value='accept'> Accept </button></td> ";
                                echo " <td> <button type='submit' name='reject' value='reject'> Reject </button></td> ";
                                echo "<input type='hidden' name='number' value='".$row['number']."'> ";
                                echo "</tr></form>";
                            }
                        ?>

                    </tbody>
                </table>
            </div>
</div>


        <div class="card-footer align-center">
            <h4><button> <a href="../index.php">Logout</a> </button> </h4>
        </div>

    </body>
</html>