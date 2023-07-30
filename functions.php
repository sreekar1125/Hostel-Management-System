<?php
    

    function random_num($length)//function not used in the code. Instead tables with auto incremenet id's are generated.
    {
        $text = "";
        if($length < 5)
        {
            $length = 5;
        }
        $len = rand(4,$length);
        for($i=0; $i< $len; $i++){
            $text = rand(0,9); 
        }
        return $text;
    }
?>