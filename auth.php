<?php
//Verifies the login credentials of the Owner/Hosteler
    session_start();//A session is a way to store information (in variables) to be used across multiple pages.
    include("connection.php");
    include("functions.php");

       $own_number = $_POST['own_number'];//used to collect form data from submission where form action = "post"
        $password = $_POST['password'];
       
        $query = "select * from owner where number = '".$own_number."' AND password = '".$password."' limit 1";
        $query1 = "select * from hostler where number = '".$own_number."' AND password = '".$password."' limit 1";

        $result = mysqli_query($con ,$query);//to check if there exists an owner with the given details in the db.
        $result1 = mysqli_query($con, $query1);

        $count = mysqli_num_rows($result);  
        $count1 = mysqli_num_rows($result1);
          
        if($count == 1){  //If there exists an owner with the given number and password
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['number'] = $own_number;
            header("location:owner/calci.php");
        } else if($count1 == 1){//else check if there exists any hosteler with given records
            $user_data = mysqli_fetch_assoc($result1);
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['number'] = $own_number;
            header("location:hostler/status.php");
        }
        else{//neither owner nor hosteler
            header('location:index.php?error=1');
        }  

   
?>