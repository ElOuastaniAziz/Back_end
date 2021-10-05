<?php
    
    //connect to BD
    
    $connection = mysqli_connect('localhost','abdel','esselte14','library');
    mysqli_set_charset($connection,"utf8");


    //check the connection 
    if(!$connection){
        echo "Connection Error";
    }
    //DONT FORGET CLOSE THE CONNECTION

?>