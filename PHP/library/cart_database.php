<?php 
   //include('db/db_connect.php');
 
   $cart_state="";
   //if(isset($_POST['buy'])){
    $date = date("Y-m-d H:i:s"); 
        for($i=0;$i<count($_POST['quantity']);$i++){
          $query="insert into cart(order_number,member_id,book_title,book_id,order_date,quantity,price)
          values('$date$id_user','$id_user','".$_POST['title'][$i]."','".$_POST['iden'][$i]."','$date''".$_POST['title'][$i]."
          ','".$_POST['quantity'][$i]."','".$_POST['price'][$i]."')";
          if(mysqli_query($connection, $query)){
             
              $cart_state="done";
          }else{
            $cart_state="dont";
          }
        }
  // }
  
?>