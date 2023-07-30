<?php
    function check_login($con)
    {
        if(isset($_SESSION['user_id']))
        {
            echo "function1";
            $id = $_SESSION['user_id'];
            $query = "select * from owner where user_id = '".$id."' limit 1";

            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0)
            {
                echo "function2";
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        header("Location : index.php");
        die;
    }

    function random_num($length)
    {
        $text = "";
        if($length < 5)
        {
            $length = 5;
        }
        $len = rand(4,$length);
        for($i=0; $i< $len; $i++){
            $text .= rand(0,9); 
        }
        return $text;
    }
?>