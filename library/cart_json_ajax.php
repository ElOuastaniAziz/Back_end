<?php
    include('db/db_connect.php');
    $sql_books = "select * from book";
    
    $search_book=mysqli_query($connection,$sql_books);
    $rows = array();
    while($row = mysqli_fetch_assoc($search_book)){
        $rows[] = $row;
     
   }
   
       $json_libros=json_encode($rows);
      echo $json_libros;
      
 ?>