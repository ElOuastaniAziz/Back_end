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
       <?php if(!empty($type) && $type=='usr'):?>
        <main>
        
            <div id="menu_librarian">  
            <h3>Hi <?php  echo $name ;?></h3>             
                <ul>
                     <li ><a href="member.php">Home</a></li>
                     <li><a href="member_books.php">My books</a></li>
                    <li style="border-bottom: 3px solid #fff;"><a href="<?php echo "form_user_update.php?id=$id_user";?>">My profile</a></li>
            
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
                            $query_select_user="select * from member where member_id='$ident' ";
                             $search_user=mysqli_query($connection,$query_select_user);
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
                                    $user_pass=$row['pass'];
                                }
                                if(empty($image)){
                                    //when the user doesn't have image , will take this default image
                                    $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/avatar.png';
                                }else{
                                    //if does , will gate the  image from directory of images.
                                    $dir_images = $_SERVER['SERVER_NAME'].'/lib/images/users_images/'.$image;
                                }  
                                //INTENRAR RELLENAR LOS VALORES CON JAVASCRIPT
                            } 
                                                          
                            ?>
                           
                                                            
                                <div id="register">  
                                <!-- $_SERVER["PHP_SELF"])."?id=$user_id", to reload the page  with the same user id ,ones is done the post -->             
                                 <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=$user_id";?>" method="post" enctype="multipart/form-data">
                                     <div id="register_col1">
                                         <label for="nombre">Name * : </label>
                                         <input type="text" name="name" id="name" placeholder="" required/>
                     
                                         <label for="lastname">LastName * : </label>
                                         <input type="text" name="lastname" id="lastname" placeholder="" required/>
                                         <label for="email">E-mail * : </label>
                                         <input type="email" name="email" id="email" placeholder="" required/>
                     
                                         <label for="phone">Phone * : </label>
                                      <input type="tel" name="phone" id="phone" placeholder="" required/>
                                     </div>
                                     <div id="register_col2">
                                         <label for="street">Street* : </label>
                                         <input type="text" name="street" id="street" placeholder="" required/>
                     
                                         <label for="city">City* : </label>
                                         <input type="text" name="city" id="city" placeholder="" required/>     
                                         <label for="pass">Password * : </label>
                                         <input type="password" name="pass" id="pass" placeholder="" required/>
                                        <!-- user image -->
                                        <img  style="width:50px; height:50px; margin-left:20px;" id="imatge"/>
                                         <input type="file" name="imagen" id="imagen" value="  change image " accept="image/*" />
                                         <input type="submit" value="Update user" name="update" id="register_btn"/>'   
                                         <!--          <img src="" style="width:50px; height:50px; margin-left:20px;" /> -->                      
                               

                                        <!-- JAVASCRIPT-->
                                        <script>
                                        //var URLactual = window.location;
                                       // alert(URLactual);
                                    
                                                     
                                                     document.getElementById("name").value="<?php echo $user_name ;?>";
                                                    document.getElementById("lastname").value="<?php echo $user_lastName ;?>";
                                                    document.getElementById("email").value="<?php echo  $user_email ;?>";
                                                    document.getElementById("phone").value="<?php echo $user_phone ;?>";
                                                    document.getElementById("street").value="<?php echo $user_street ;?>";
                                                    document.getElementById("city").value="<?php echo $user_city ;?>";
                                                    document.getElementById("pass").value="<?php echo $user_pass ;?>";
                                                    document.getElementById("imatge").src="<?php echo $protocol.$dir_images ; ?>";
                                                    if( document.getElementById("imagen").files.length == 0 ){
                                                        console.log("no files selected");
                                                    }
                                                   // document.getElementById("pic1").src= searchPic.src;
                                                                                                
                                    </script>

                                               
                             <?php 
                          
    
                          if(isset($_POST['update'])){
                              include('db/db_connect.php');
                                  
                                  $user_name = $_POST['name'] ;//?? null;
                                  $lastname = $_POST['lastname'] ;
                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $street = $_POST['street'];
                                  $city = $_POST['city'];
                                  $pass = $_POST['pass'];
                                //$imag = $_POST['imagen'] ?? null ;
                               
                                                           
                                 
                                  //include('db/db_connect.php');
                                  if(!empty($name) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($street) && !empty($city)
                                  && !empty($pass)){
                                      //to avoid save am empty resgiter of image, first check if  input file is empty,
                                      //if does will get the picture saved in our DB.
                                    if($_FILES['imagen']['name'] == "") {
                                        $nombre_imagen=$image;
                                    
                                     } else{
                                        $nombre_imagen=$_FILES['imagen']['name'];
                                        $tipo_imagen=$_FILES['imagen']['type'];
                                        $tamanyo_imagen=$_FILES['imagen']['size'];
                                        
                                     }  
                                  
                                  
                                    
                                        //RUTA DEL CARPETA DESTINO 
                                        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/lib/images/users_images/';
                                        //mover la imagen del directorio temporal al directorio escogido
                                        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_imagen);
                                        
                                                
                                   
                                     $queryUpdate="UPDATE member SET Name = '$user_name', lastName='$lastname',email='$email',
                                     phone='$phone',street='$street',city='$city',pass='$pass',img='$nombre_imagen' where member_id='$ident'";
                                     
                                      if ( mysqli_query($connection,$queryUpdate)) {  
                                          //echo "user created successfully";   
                                             echo "<h3>User count updated</h3>";
                                             
                                             sleep(2);
                                             ?>
                                                          
                                             
                                           <script type="text/javascript">
                                                window.onload=function(){ 
                                                    top.location.href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$user_id;?>";
                                                };
                                                
                                        </script>                        
                                        
                                   
                                   
                                    <?php                                               
                                      } else {
                                          echo "Error: " . $queryUpdate . "<br>" . mysqli_error($connection);
                                      }

                                                                                                           
                                    
                                    }
                                  
      
                          }
        

        ?>
       <?php endif; ?>
         
        </main>
       
    </body>
    <?php include('footer.php');?>
<script>

</script>
      
    
</html>
                            