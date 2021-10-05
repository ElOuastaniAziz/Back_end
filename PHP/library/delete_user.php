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
               <!-- <ul>
                     <li  style="border-bottom: 3px solid #fff;"><a href="librarian.php">Home</a></li>
                     <li><a href="form_book_insert.php">Create</a></li>
                    <li><a href="form_book_delete.php">Delete</a></li>
                    <li><a href="form_book_update.php">Modifier</a></li>
                </ul>-->
            
         </div>
          
         <?php 
         //If el button search is clicked then connect to the BD and seearch the book.
             
                include('db/db_connect.php');
                if(isset($_GET['id'])){
                    $ident=mysqli_real_escape_string($connection,$_GET['id']);
                }
                            $query_delete_user="delete from member where member_id='$ident' ";
                           // $search_book=mysqli_query($connection,$query_delete_user);
                            // Read record
                           /* while($row = mysqli_fetch_assoc($search_book)){
                               // $id=$row['book_id'];
                                $title= $row['title'];
                                $isbn= $row['isbn'];
                            }*/
                         
                             /*  $query_member_id= "select member_id from member where name='$name'";
                               $search_member=mysqli_query($connection, $query_member_id);
                               $member_id='';
                               while($row = mysqli_fetch_assoc($search_member)){
                                   $member_id=$row['member_id'];
                               
                               }  
                               $date_book= date("Y/m/d") ;
                               $interval = date('Y-m-d', strtotime($date_book.' + 30 days' ));         
                               $query_insert_borrow="insert into reservation(member_id,book_id,date_borrow,date_return)
                               values('$member_id','$ident','$date_book','$interval')";
                                */
                                if(mysqli_query($connection, $query_delete_user )){
                                    
                                   echo "<h4 style='color:green; margin-left:20px;'>The user is delete</h4>
                                   <a href='form_librarian_user_select.php'/>Come back </a>";
                            
                               }else{
                                   echo "<h4 style='color:red; margin-left:20px;'>Something wrong !</h4>";
                               }  
                             //  sleep(5);
                               // header('Location: member.php'); 
                                
            mysqli_close($connection);

        ?>
         
       
         <?php endif; ?>
        </main>
       
    </body>
    <?php include('footer.php');

        clearstatcache();
    ?>
</html>
 