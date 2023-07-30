<?php
//Hostel registration page just after the UI registration page
//This page is used to fill the personal details of the owner and the hostel details along with mess details
    session_start();

    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id = $_SESSION['user_id'];
        $ownName = $_POST['name'];
        $mail = $_POST['email'];
        $number = $_SESSION['number'];
        $hstlName = $_POST['hstlName'];
        $room = $_POST['room'];
        $roomLeft = $_POST['roomLeft'];
        $address = $_POST['address'];

        $monB = $_POST['monB']; //Asking for the menu from the owner during registration
        $monL = $_POST['monL']; //Here 'B' stands for breakfast, l stands for lunch and D for dinner respectively.
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
        
        $query1 = "insert into `$id`(ownName,mail, number, hstlName, room, address, bf,lunch,dinner) values ('$ownName','$mail', '$number', '$hstlName', '$room', '$address','$bf[0]','$lunch[0]', '$dinner[0]')";
       mysqli_query($con ,$query1);
       for($i = 1; $i < 7; $i++){//inserting the user input values into the database iteratively.
        $query = "insert into `$id`(bf,lunch, dinner) values ('$bf[$i]','$lunch[$i]', '$dinner[$i]')";
        mysqli_query($con ,$query);
       }
    //add the number of rooms left and address and also update the incomplete record of the owner(50-54)
       $query2 = "update owner set name = '$ownName', address = '$address', roomLeft = '$roomLeft' where number = '$number' ";
       mysqli_query($con ,$query2);
       echo "<script>window.location.href='calci.php';</script>";
       //redirect to calci.php after succesful registration
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hostel Managment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <form method="POST">

         <section class="form-08" style="overflow: scroll;">
      <div class="container-fluid" style="opacity:0.9">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
              <div class="_form-08-head">
                <h1>Hostel Registeration</h1>
              </div>
                  <div class="_form-08-head">
                <h2>Owner</h2>
              </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
               <div class="_form-08-head">
                <h2>Hostel</h2>
              </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="hstlName" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="room" placeholder="No. of Rooms" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="roomLeft" placeholder="No. of Rooms Left" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                 <div class="_form-08-head">
                <h2>Menu</h2>
              </div>
          <table class="table table-hover table-striped table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th scope="col">Day</th>
                <th scope="col">BreakFast</th>
                <th scope="col">Lunch</th>
                <th scope="col">Dinner</th>
              </tr>
            </thead>
            <tbody>
              <tr>
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
    </div>
    </form>

</body>

</html>