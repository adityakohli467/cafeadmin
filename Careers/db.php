<?php

$servername = "localhost";
$username = "linrefvy_hr_portal";
$password = "212x[j4=WmH!";
$db = "linrefvy_hr_portal";
try {
   
    $con = new mysqli($servername, $username, $password, $db);
    
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
 

?>