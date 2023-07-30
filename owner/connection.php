<?php
    $servername = "sql208.epizy.com";
    $username = "epiz_27881458";
    $password = "Hik9wjsVhAcvqA";
    $dbname = "epiz_27881458_hstlMgmt";
    
    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
    ?>