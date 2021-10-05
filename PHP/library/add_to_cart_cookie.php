<?php
    $cart=array();
   
    $iden=$_GET['iden'];
    array_push($cart,$iden);
    $json_cart = json_encode($cart);
    setcookie("cart",$json_cart,time()+84600);

    //cojer la la cookie
    $cookie = $_COOKIE['cart'];
    $cookie = stripslashes($cookie);
    $savedCardArray = json_decode($cookie, true);

    print_r($savedCardArray);
?>