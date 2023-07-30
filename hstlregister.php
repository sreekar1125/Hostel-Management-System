<?php
    //Apply for hostel page
    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") // determines whether the request was a POST request.
    {
        $own_number = $_POST['own_number'];//copies form data into variables
        $password = $_POST['password'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $aadhaar = $_POST['aadhaar'];
        $status = 3;

        if(preg_match('/^\d{10}$/',$own_number)) // checks if the entered number is 10 digits long.
        {
            // verify if number exists
            $query1 = "SELECT * FROM hostler WHERE number = '$own_number' ";
            $res = mysqli_query($con,$query1);
            $row = mysqli_fetch_array($res);

                // check if user number already exist
                if($row > 0) {
                    $invalid = "Number Already Exists";
                } 
                else {
               
            $id = random_num(5);

            $query = "insert into hostler(id,name,number,password, address, aadhaar,status) values ('$id', '$name','$own_number','$password','$address','$aadhaar','$status')";//enters the hosteler details into the hostel table
            mysqli_query($con ,$query);

            $_SESSION['user_id'] = $id;
            $_SESSION['number'] = $own_number;

            echo "<script>window.location.href='hostler/status.php';</script>";
            exit;
            }
        } else{
            $invalid = "Invalid Mobile number !"; 
        }

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

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <form method="POST">
        <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <div class="form-03-main">
                <div class="logo">
                  <img src="assets/images/user.png">
                </div> <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="own_number" placeholder="Number" name="own_number"  maxlength="10"  required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" minlength="8" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="aadhaar" placeholder="Aadhaar" minlength="12">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit">Register</button>
                </div>
                <div class="form-group">
                   <h4 style="color : red; font:bold"> <?php echo $invalid ?> </h4>
                </div>
            </div>
            <div class="form-group">
                  <div class="_btn_04">
                    <a href="index.php">Had an account?</a>
                  </div>
                </div>
                
              
        </div>
    </div>
    </form>

</body>
</html>
