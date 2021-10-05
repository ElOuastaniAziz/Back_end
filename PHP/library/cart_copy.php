<!DOCTYPE html>
    <head>
            <title><?php $page_name=$_SERVER['PHP_SELF'];
                $page=explode('/',$page_name);
                echo strtoupper(substr($page[2], 0, -4));
            ?>
            </title>
            <link type="text/css"  rel= stylesheet href="css/style.css"/>
            <link rel=”shortcut icon” type=”image/png” href=”images/logo.png”/>
    </head>
    <body>

       <?php include('header.php');?>
       <?php if(!empty($type) && $type=='usr'):?>
    
        <main>
        
            <div id="menu_librarian">  
            <h3>Hi <?php  echo $name ;?></h3>             
               <ul>
                     <li><a href="member.php">Home</a></li>
                     <li style="border-bottom: 3px solid #fff;"><a href="member_books.php">My Books</a></li>
                     <li><a href="<?php echo "form_user_update.php?id=$id_user";?>">My profile</a></li>
                   
                </ul>
             
        
         </div>
          
         <?php 
        
                include('db/db_connect.php');
                               
                        $select_id_book1="SELECT * from reservation inner join member
                        on reservation.member_id=member.member_id WHERE member.email='$e_mail'";
                         $search_book_id=mysqli_query($connection,$select_id_book1);
                        
                         while($row0 = mysqli_fetch_assoc( $search_book_id)){
                            $iden=$row0['book_id'];
                            $return_date=$row0['date_return'];
                        
                            $query_id_book="select * from book where book_id='$iden'";                                           
                            $search_book=mysqli_query($connection,$query_id_book);
                            // Read record
                            while($row = mysqli_fetch_assoc($search_book)){
                                $id=$row['book_id'];
                                $title= $row['title'];
                                $author = $row['author'];
                                $category= $row['category'];
                                $isbn= $row['isbn'];
                                $date1 = $row['created_at'];
                                $date2=explode(" ",$date1);
                                $image =$row['img'];
                                $editorial=$row['editorial'];
                                $language=$row['languagge'];
                                $price=$row['price'];
                                
                            }
                            if(empty($image)){
                                $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/no_image.jpg';
                            }else{
                                $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/'.$image;
                            }           
                                   
                                echo  '<article>
                                <table>
                                    <tr><th>Units</th><th>Product</th><th>Price</th></tr>
                                    <tr><td>1</td><td>';
                                     echo $title ; 
                                     echo '</td><td>';
                                      echo $price ; 
                                      echo '</td></tr>
                               </table>

                                </article>';
                               
                             
                        }
                            ;?>
         
     
         <?php endif; ?>
      
      
        </main>
       
    </body>
    <?php include('footer.php');

        clearstatcache();
    ?>
</html>
 