<?php
//Redirected to this page when an applicant who is not yet assigned a hostel tries to login.
    session_start();

    include("connection.php");
    include("functions.php");

    $number = $_SESSION['number'];
    $id = $_SESSION['user_id'];

    $query = "select * from hostler where number = '$number'";
    $res = mysqli_query($con,$query);
    $row = mysqli_fetch_array($res);

    $status =(int) $row['status'];

    
    if($_SERVER['REQUEST_METHOD'] == "POST")//to send the application to the owner. Status =2 implies the decision is pending.
    {
        $hsId = $_POST['number'];
        $status1 = 2;
        $query2 = "update hostler set hstl = '$hsId', status = '$status1' where number = '$number' ";
        mysqli_query($con,$query2);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hostel Managment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
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

</head>

<body>

    <div class="bg" >
        <div class="card border-success" style="opacity:0.9; background:transparent;">
            <div class="card-header bg-primary text-white">
                <h1><b>Hostel Status</b></h1>
            </div>
            <div class="card-body">
                <?php
                //Status = 1 -->Accepted 
                # 0 --> Rejected
                # 2 --> Pending
                #3 --> Applicant yet to select the hostel
                    if( $status == 1 ){
                        echo "<script>window.location.href='hstlr.php';</script>";
                    } else if($status == 2){
                        echo "<h3><b>Your application is being processed</b></h3>";
                    } else if( $status == 3 || $status == 0 ){
                        if( $status == 0 ){
                             echo "<h3><b>Your application has been rejected</b></h3>";
                            echo "<h4>Apply for new hostel</h4>";
                        }
//the lines below is used to display  the table structure to diplay all the available hostels in a table along with the feature to apply for the same(status = 3)
                        echo "<table class='table table-hover table-striped table-bordered table-responsive-sm'> 
                        <thead>
                        <tr>
                            <th scope='col'>Hostel Name</th>
                            <th scope='col'>Number</th>
                            <th scope='col'>Address</th>
                            <th scope='col'>Rooms Available</th>
                            <th scope='col'>Send Request</th>
                        </tr>
                        </thead>
                        <tbody>";
//Select the available hostels
                        $query1 = "select * from owner";
                        $res1 = mysqli_query($con,$query1);
                        while($row1 = mysqli_fetch_array($res1)){
                            echo "<tr> <td>".$row1['name']."</td>";
                            echo "<td>".$row1['number']." </td>";
                            echo "<td>".$row1['address']." </td>";
                            echo "<td>".$row1['roomLeft']." </td>";
                            echo " <form method='POST'> ";
                            echo " <td> <button type='submit' name='action' > Apply </button></td> ";
                            echo "<input type='hidden' name='number' value='".$row1['id']."'> ";
                            echo "</tr></form>";
                        }
                        echo "</tbody>";
                    }
                ?>
            </div>
        </div>
    </div>

</body>

</html>