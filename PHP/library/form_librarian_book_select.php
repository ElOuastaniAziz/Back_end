<!DOCTYPE html>
    <head>
            <title><?php $page_name=$_SERVER['PHP_SELF'];
                $page=explode('/',$page_name);
                echo strtoupper(substr($page[2], 0, -4));
                 //tipo de protocolo
                     $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            ?>
            </title>
            <link type="text/css"  rel= stylesheet href="css/style.css"/>
            <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
    </head>
    <body>

       <?php include('header.php');?>
       <?php if(!empty($type) && $type=='lib'):?>
       
        <main>
            
         <div id="buscador">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="text" name="buscarLibro" id="buscarLibro" placeholder="  Search your item here" />
                    <input type="submit" name="search" id="search" value="Search" />
                </form>
        </div>
         </div>
         <h3>Hi <?php  echo $name ;?></h3>
    
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
        if(isset($_POST['search'])){
            include('db/db_connect.php');
                
                $bookTitle = $_POST['buscarLibro'] ?? null;
                //include('db/db_connect.php');
                if(!empty($bookTitle)){
                        $query1="select * from book  where title like '$bookTitle' or title like '%$bookTitle' or title like '$bookTitle%' or title like '%$bookTitle%'";
                        $search_book=mysqli_query($connection,$query1);
                        // Read record
                        while($row = mysqli_fetch_assoc($search_book)){
                            $title= $row['title'];
                            $author = $row['author'];
                            $category= $row['category'];
                            $isbn= $row['isbn'];
                            $date1 = $row['created_at'];
                            $date2=explode(" ",$date1);
                            $image =$row['img'];
                            //images directory
                            //SIN CARPETA DENTRO $dir_images = $_SERVER['SERVER_NAME'].'/images/'.$image;
                            if(empty($image)){
                                $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/no_image.jpg';
                            }else{
                               $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/'.$image;
                              
                            }           
                            echo  '<article>
                                <img src="'.$protocol.$dir_images.'" alt="'.$image.'"/>
                                <h3>'.$title.'</h3>
                                <p>Author :'.$author.'</p>
                                <p>Category : '.$category.'</p>
                                <p>ISBN : '.$isbn.'</p>
                                <p>Publishid in : '.$date2[0].'</p>
                            </article>';
                            
                        }
                }

        }
                clearstatcache();
 ?>