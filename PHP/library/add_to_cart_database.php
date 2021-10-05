<?php

    $iden=$_GET['iden'];
    include('db/db_connect.php');
    $query1="select * from book where book_id=$iden";
    $search_book1=mysqli_query($connection,$query1);
                // Read record
     while($row = mysqli_fetch_assoc($search_book1)){
                    $quantity=1;
                    $title= $row['title'];
                    $price=$row['price'];
     }
   
     $query2="insert into cart(quantity,book_title,price) values($quantity,'$title','$price')";
    if(mysqli_query($connection,$query2)){
        echo "Added to cart";
    }else{
        echo "error";
    }
 
     
?>