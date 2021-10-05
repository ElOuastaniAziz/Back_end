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
                        <h3>Hi <?php  echo $name;?></h3>             
                            <ul>
                               
                                <li><a href="librarian.php">Home</a></li>
                                <li  style="border-bottom: 3px solid #fff;"><a href="form_librarian_user_select.php">Users</a></li>
                                <li><a href="form_book_insert.php">Add a new book</a></li>
                                
                            </ul>
                            <div id="buscador_librarian">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <input type="text" name="buscarUser" id="buscarLibro_librarian" placeholder="  Search your item here" />
                                    <input type="submit" name="search_librarian" id="search_librarian" value="Search" />
                                </form>
                        </div>
                    
                    </div>
         <?php 
            //tipo de protocolo
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
                     
         //If el button search is clicked then connect to the BD and seearch the book.
              if(isset($_POST['search_librarian'])){
                include('db/db_connect.php');
                $userTag = $_POST['buscarUser'] ?? null;
                //include('db/db_connect.php');
                if(!empty($userTag)){
                        $query1="select  * from member where name='$userTag' && tipo!='lib'";// where name like '$userTag' or email like '%$userTag' or email like '$userTag%' or  email '%$userTag%'";
                        $search_user=mysqli_query($connection,$query1);
                        // Read record
                        while($row = mysqli_fetch_assoc($search_user)){
                   
                                $user_id= $row['member_id'];
                                $user_name= $row['Name'];
                                $user_lastName= $row['lastName'];
                                $user_email = $row['email'];
                                $user_phone= $row['phone'];
                                $user_street= $row['street'];
                                $user_city= $row['city'];
                                $user_pin= $row['pin'];
                                $user_date_pin= $row['date_pin'];
                                $image=$row['img'];
                     
                            //images directory
                            //SIN CARPETA DENTRO $dir_images = $_SERVER['SERVER_NAME'].'/images/'.$image;
                           if(empty($image)){
                                //when the user doesn't have image , will take this default image
                                $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/avatar.png';
                                
                                //  $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/avatar.png';
                            }else{
                                //if does , will gate the  image from directory of images.
                                $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/'.$image;
                            }   
                            
                              echo  '<article>
                              <img src="'.$protocol.$dir_images.'" alt="user pciture"/>
                              <h3>'.$user_name.'</h3>
                              <p>LastName :'.$user_lastName.'</p>
                              <p>Email: '.$user_email.'</p>
                              <p>Phone : '.$user_phone.'</p>
                              <p>Address : '.$user_street.'</p>
                              <p>City : '.$user_city.'</p>';
                              //show if user has got penalties
                              if($user_pin>0){
                                  echo '
                                  <p>Penalty: '.$user_pin.'days on date: '.$user_date_pin.'</p>';
                              }
                              
                              echo '
                              <a href="form_librarian_user_update.php?id='.$user_id.'" id="'.$user_id.'" name="bookk" style=" height:40px;
                              width:120px; background-color:green; border:0;" onclick=";">Modify</a>
                              ';?>
              
                              <a href="#" id="'.$user_id.'" name="bookk" style=" height:40px;
                              width:120px; background-color:red; border:0;" onclick=' var opcion = confirm("Are you sure to delete this user?");
                                                              if (opcion == true) {
                                                                  window.location.replace("delete_user.php?id="+<?php echo $user_id;?>);
                                                              } else {
                                                                  window.location.replace("form_librarian_user_select.php");
                                                              }'>Delete</a>
              
                              <?php echo '
                              <br/>
                              <br/>
                          </article>';
                                
                                
                        }
                    }
            //if button search is not clicked, connect to db and select the last 4 books.
            }else{
                include('db/db_connect.php');
                $query1="select  * from member order by member_id desc";//order by member_id desc limit 4";
                $search_user=mysqli_query($connection,$query1);
                // Read record
                while($row = mysqli_fetch_assoc($search_user)){
                    $user_type = $row['tipo'];
                    if($user_type!='lib'){
                        $user_id= $row['member_id'];
                        $user_name= $row['Name'];
                        $user_lastName= $row['lastName'];
                        $user_email = $row['email'];
                        $user_phone= $row['phone'];
                        $user_street= $row['street'];
                        $user_city= $row['city'];
                        $user_pin= $row['pin'];
                        $user_date_pin= $row['date_pin'];
                        $image=$row['img'];
                    }
                  

                    //images directory
                    //SIN CARPETA DENTRO $dir_images = $_SERVER['SERVER_NAME'].'/images/'.$image;
                   if(empty($image)){
                        //when the user doesn't have image , will take this default image
                       
                        $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/avatar.png';
                    }else{
                        //if does , will gate the  image from directory of images.
                        $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/'.$image;
                    }           
                    
             
                echo  '<article>
                <img src="'.$protocol.$dir_images.'" alt="user pciture"/>
                <h3>'.$user_name.'</h3>
                <p>LastName :'.$user_lastName.'</p>
                <p>Email: '.$user_email.'</p>
                <p>Phone : '.$user_phone.'</p>
                <p>Address : '.$user_street.'</p>
                <p>City : '.$user_city.'</p>';
                //show if user has got penalties
                if($user_pin>0){
                    echo '
                    <p>Penalty: '.$user_pin.' days on date: '.$user_date_pin.'</p>';
                }
               
                echo '
                <a href="form_librarian_user_update.php?id='.$user_id.'" id="'.$user_id.'" name="bookk" style=" height:40px;
                width:120px; background-color:green; border:0;" onclick=";">Modify</a>
                ';?>

                <a href="#" id="'.$user_id.'" name="bookk" style=" height:40px;
                width:120px; background-color:red; border:0;" onclick=' var opcion = confirm("Are you sure to delete this user?");
                                                if (opcion == true) {
                                                    window.location.replace("delete_user.php?id="+<?php echo $user_id;?>);
                                                } else {
                                                    window.location.replace("form_librarian_user_select.php");
                                                }'>Delete</a>

                <?php echo '
                <br/>
                <br/>
            </article>';
            }
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
<?php 
    /*TAMAÑO tipo
    con el la variable guardada,
    if($tamaño_imagen<=1000000){ //menor de un MB
    if($tipo_imagen=="image/jpg" || $tipo_imagen=="image/png"){
        $carpeta_destino=...
        move_uploaded}
        else{
            echo "solo se pueden imagenes";
        }
    }else{
        echo 'el tamaño es grande' ;
    }
    
 */
     