<!DOCTYPE html>
    <head>
            <title>Add Book</title>
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
                <li><a href="form_librarian_user_select.php">Users</a></li>
                     <li style="border-bottom: 3px solid #fff;"><a href="form_book_insert.php">Add a new book</a></li>
                     
                </ul>
                  
         </div>
            <div id="add_book">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  enctype="multipart/form-data">
                    <div id="add_book_col1">
                    <label for="title">Title * : </label>
                        <input type="text" name="title" id="title" placeholder="  Book title"/>
                    <label for="isbn">ISBN * : </label>
                        <input type="text" name="isbn" id="isbn" placeholder="  Book ISBN"/>
                    <label for="author">Author * : </label>
                        <input type="text" name="author" id="author" placeholder="  Book title"/>
                    <label for="editorial">Editorial * : </label>
                        <input type="text" name="editorial" id="editorial" placeholder="  Editorial"/>
                    <label for="book_type">Type * : </label>
                        <input type="text" name="book_type" id="book_type" placeholder="  Paper/Digital"/>
                    </div>
                    <div id="add_book_col2">
                    <label for="category">Category * : </label>
                        <input type="text" name="category" id="category" placeholder="  Category"/>
                    <label for="language">Language * : </label>
                    <input type="text" name="language" id="language" placeholder="  Language"/>
                    <label for="location">Location * : </label>
                    <input type="text" name="location" id="location" placeholder="  Location"/>

                  

                    <label for="image">Upload Image : </label>
                    <input type="file" name="imagen" placeholder="  Upload image here" accept="image/*" />
                    <input type="submit" value="Create" name="create_btn" id="login_btn"/>

                    <!-- CÓDIGO PHP -->
                    <?php
    
                    if(isset($_POST['create_btn'])){
                            $title= $_POST['title'];
                            $author = $_POST['author'];
                            $category= $_POST['category'];
                            $isbn= $_POST['isbn'];
                            $book_tipo=$_POST['book_type'];
                            $book_tipo=strtolower($book_tipo);
                            $nombre_imagen=$_FILES['imagen']['name'];
                            $tipo_imagen=$_FILES['imagen']['type'];
                            $tamanyo_imagen=$_FILES['imagen']['size'];
                            //RUTA DEL CARPETA DESTINO 
                             $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/lib/images/';
                             //mover la imagen del directorio temporal al directorio escogido
                             move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_imagen);
                            $editorial = $_POST['editorial'];
                            $category = $_POST['category'];
                            $language = $_POST['language'];
                            $location = $_POST['location'];
                           
                            include('db/db_connect.php');
                            $query_insert_book ="insert into book(title,author,category,isbn,img,editorial,languagge,location_id,tipo) 
                            values('$title','$author','$category','$isbn','$nombre_imagen','$editorial','$language','$location','$book_tipo')";
                           
                            //Check if the shelf is full 
                            $query_shelf="select * from location";
                            $search_isfull=mysqli_query($connection,$query_shelf);
                            while($row_shelf = mysqli_fetch_assoc($search_isfull)){
                                $isfull = $row_shelf['isfull'];
                            } 
                            //will check if the shelf is not full                 
                            if($isfull==0){
                                if(mysqli_query($connection,$query_insert_book)){
                                    echo "<h4 style='color:green; margin-left:20px;'>The book with title '$title' is added</h4>";
                                                                                                             
                                }else{
                                    echo "<h4 style='color:red; margin-left:20px;'>Something wrong !</h4>";
                                }  
                            }else{
                                echo "<h4 style='color:red; margin-left:20px;'>The shelf is full, please select a diferent location</h4>";
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