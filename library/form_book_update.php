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
               <ul>
                     <li><a href="librarian.php">Home</a></li>
                     <li><a href="form_book_insert.php">Add a new book</a></li>
                </ul>
            
         </div>
                
         <?php 
          //tipo de protocolo
          $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
         //If el button search is clicked then connect to the BD and seearch the book.
             $ident="";
                include('db/db_connect.php');
                if(isset($_GET['id'])){
                    $ident=mysqli_real_escape_string($connection,$_GET['id']);
                }
                            $query_select_book="select * from book where book_id='$ident' ";
                             $search_book=mysqli_query($connection,$query_select_book);
                            // Read record
                            while($row_sql = mysqli_fetch_assoc($search_book)){
                            
                                    $id_sql= $row_sql['book_id'];
                                    $title_sql= $row_sql['title'];
                                    $author_sql = $row_sql['author'];
                                    $category_sql= $row_sql['category'];
                                    $isbn_sql= $row_sql['isbn'];
                                    $editorial_sql = $row_sql['editorial'];
                                    $category_sql = $row_sql['category'];
                                    $language_sql = $row_sql['languagge'];
                                    $location_sql = $row_sql['location_id'];
                                    $tipo_sql = $row_sql['tipo'];
                                    $img_sql=$row_sql['img'];
                                }
                                if(empty($img_sql)){
                                    //when the user doesn't have image , will take this default image
                                    $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/no_image.jpg';
                                }else{
                                    //if does , will gate the  image from directory of images.
                                    $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/'.$img_sql;
                                }  
                                //INTENRAR RELLENAR LOS VALORES CON JAVASCRIPT
                            
                            ?>
            <div id="add_book">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=$id_sql";?>" method="post" enctype="multipart/form-data">
                    <div id="add_book_col1">
                  <!--  <label for="book_id">Book ID* : </label>
                        <input type="text" name="book_id" id="book_id" placeholder="  Book ID"/> -->
                    <label for="title">Title * : </label>
                        <input type="text" name="title" id="title" placeholder="  Book title"/>
                    <label for="isbn">ISBN * : </label>
                        <input type="text" name="isbn" id="isbn" placeholder="  Book ISBN"/>
                    <label for="author">Author * : </label>
                        <input type="text" name="author" id="author" placeholder="  Book title"/>
                    <label for="editorial">Editorial * : </label>
                        <input type="text" name="editorial" id="editorial" placeholder="  Editorial"/>
                         <!-- book image -->
                         <img  style="width:70px; height:50px; margin-left:20px;" id="imatge"/>
                        <label for="image">Upload Image* : </label>
                    <input type="file" name="imagen" placeholder="  Upload image here" accept="image/*" />
                    
                    </div>
                    <div id="add_book_col2">
                    <label for="category">Category * : </label>
                        <input type="text" name="category" id="category" placeholder="  Category"/>
                    <label for="language">Language * : </label>
                    <input type="text" name="language" id="language" placeholder="  Language"/>
                    <label for="location">Location * : </label>
                    <input type="text" name="location" id="location" placeholder="  Location"/>
                    <label for="book_type">Type * : </label>
                        <input type="text" name="book_type" id="book_type" placeholder="  Papper/Digital"/>
                        <input type="submit" value="Update" name="update_btn" id="login_btn"/>
                            </div>

                    
                         <!-- JAVASCRIPT-->
                         <script>
                                        //var URLactual = window.location;
                                       // alert(URLactual);
                                    
                                                     
                                    document.getElementById("title").value="<?php echo $title_sql ;?>";
                                     document.getElementById("isbn").value="<?php echo $isbn_sql ;?>";
                                      document.getElementById("author").value="<?php echo  $author_sql ;?>";
                                    document.getElementById("editorial").value="<?php echo $editorial_sql ;?>";
                                     document.getElementById("category").value="<?php echo $category_sql ;?>";
                                      document.getElementById("language").value="<?php echo $language_sql ;?>";
                                      document.getElementById("location").value="<?php echo $location_sql ;?>";
                                      document.getElementById("book_type").value="<?php echo $tipo_sql ;?>";
                                      document.getElementById("imatge").src="<?php echo $protocol.$dir_images ; ?>";
                                        if( document.getElementById("imagen").files.length == 0 ){
                                                        console.log("no files selected");
                                        }
                                                   // document.getElementById("pic1").src= searchPic.src;
                                                                                                
                                    </script>

                    <!-- CÓDIGO PHP -->
                    <?php
    
                    if(isset($_POST['update_btn'])){
                            $title= $_POST['title'];
                            $author = $_POST['author'];
                            $category= $_POST['category'];
                            $isbn= $_POST['isbn'];
                            $editorial = $_POST['editorial'];
                            $category = $_POST['category'];
                            $language = $_POST['language'];
                            $location = $_POST['location'];
                            $book_tipo=$_POST['book_type'];
                             $book_tipo=strtolower($book_tipo);

                            if($_FILES['imagen']['name'] == "") {
                                //is image file is empty , is select the picture from DB
                                $nombre_imagen=$img_sql;
                            
                             } else{
                                $nombre_imagen=$_FILES['imagen']['name'];
                                $tipo_imagen=$_FILES['imagen']['type'];
                                $tamanyo_imagen=$_FILES['imagen']['size'];
                             }
                          
                            //RUTA DEL CARPETA DESTINO 
                             $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/lib/images/';
                             //mover la imagen del directorio temporal al directorio escogido
                             move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_imagen);
                            $editorial = $_POST['editorial'];
                            $category = $_POST['category'];
                            $language = $_POST['language'];
                            $location = $_POST['location'];
                        
                            

                            include('db/db_connect.php');
                            $query_uodate_book ="update book set title='$title' ,author='$author',   
                            category='$category',isbn='$isbn',img='$nombre_imagen',editorial='$editorial',languagge='$language',location_id='$location',tipo='$book_tipo' where book_id='$ident'";
            

                            //$title','$author','$category','$isbn','img','$editorial','$language','$location'
                            if(mysqli_query($connection, $query_uodate_book )){
                                echo "<h4 style='color:green; margin-left:50px;'>The book with title '$title' is Updated</h4>";
                                echo "<h3>User count updated</h3>";
                                             
                                sleep(2);
                                ?>
                                             
                                
                              <script type="text/javascript">
                                   window.onload=function(){ 
                                       top.location.href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id_sql;?>";
                                   };
                                   
                           </script>                        
                           
                      
                      
                       <?php 
                            }else{
                                echo "<h4 style='color:red; margin-left:50px;'>Something wrong !</h4>";
                            }  
                    }

                ?>

            </div>
                </form>
            </div>
          
         <?php endif; ?>
        </main>
    </body>
    <?php include('footer.php');

       
    ?>
</html>
