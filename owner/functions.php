<?php
//Checks if the details entered exist in the owner table<<unused>>
    function check_login($con)
    {
        if(isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "select * from owner where user_id = '$id' limit 1";

            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        header("Location : index.php");
        die;
    }
?>