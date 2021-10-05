<!DOCTYPE html>
    <head>
            <title><?php $page_name=$_SERVER['PHP_SELF'];
                $page=explode('/',$page_name);
                echo strtoupper(substr($page[2], 0, -4));
            ?>
            </title>
            <link type="text/css"  rel= stylesheet href="css/style.css"/>
            <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
    </head>
    <body>

       <?php include('header.php');?>
       <?php if(!empty($type) && $type=='lib'):?>
        <main>
        
            <div id="menu_librarian">  
            <h3>Hi <?php  echo $name ;?></h3>             
                          
         </div>
          
         <?php 
       
             
                include('db/db_connect.php');
                if(isset($_GET['id'])){
                    $ident=mysqli_real_escape_string($connection,$_GET['id']);
                }
                            $query_delete_book="delete from book where book_id='$ident' ";
                           
                                if(mysqli_query($connection, $query_delete_book )){
                                    
                                   echo "<h4 style='color:green; margin-left:20px;'>The Book is deleted</h4>
                                   <a href='librarian.php'/>Come back </a>";
                            
                               }else{
                                   echo "<h4 style='color:red; margin-left:20px;'>Something wrong !</h4>";
                               }  
                             
                                
            mysqli_close($connection);

        ?>
         
       
         <?php endif; ?>
        </main>
       
    </body>
    <?php include('footer.php');

        clearstatcache();
    ?>
</html>
 