<!DOCTYPE html>
    <head>
            <title><?php

use function PHPSTORM_META\type;

                $page_name=$_SERVER['PHP_SELF'];
                $page=explode('/',$page_name);
                echo strtoupper(substr($page[2], 0, -4));
            ?>
            </title>
            <link type="text/css"  rel= stylesheet href="css/style.css"/>
            <link rel=”shortcut icon” type=”image/png” href=”images/logo.png”/>
    </head>
    <body>

       <?php include('header.php');?>
       
    
        <main>
       
            <div id="menu_librarian">  
            <h3>Hi <?php  echo $name ;?></h3> 
                <?php if(!empty($type) && $type=='usr'):?>         
               <ul>
                     <li><a href="member.php">Home</a></li>
                     <li><a href="member_books.php">My Books</a></li>
                     <li><a href="<?php echo "member_orders.php?id=$id_user";?>">My Orders</a></li>
                     <li><a href="<?php echo "form_user_update.php?id=$id_user";?>">My profile</a></li>

                  
                   
                </ul>
                <?php endif; ?>
               
         </div>
      
    
      <article id="cart" style="margin-top:-200px;">
      <?php 
         include('db/db_connect.php');
         ?>
         <?php
         $sql_books = "select * from book";
    
         $search_book=mysqli_query($connection,$sql_books);
         $rows = array();
         while($row = mysqli_fetch_assoc($search_book)){
             $rows[] = $row;
          
        }
        
            $json_libros=json_encode($rows);
           
        
            ?>
            </script>
              <form id="formulario" action="cart.php" method="post" enctype="form-data/multipart">
        
             </form>
             <div id="resultado">
             </div>
    
            <div id="display_empty" style="width: 360px; margin:auto; margin-top:10px; display:none;">
                <h2 id="exito"></h2>
               <h3>The cart is empty</h3>

            </div>
                 
        
      </article>
      <script>
         
        var books_table=<?php echo $json_libros;?>;
        //var session_ok=<1?php echo $id_user;?>;
        //alert(session_ok);
        //ESTABA AQUÍ
        </script>
        
             <script type="text/javascript" src="js/showCart.js" id="script1"></script>
             <script type="text/javascript" src="js/updateCart.js" id="script2"></script>
            
    
                
            <?php 
              
             
                  
                if(isset($_POST['buy'])){
               
                     if($type=='usr'){
                          include('db/db_insert_orders.php');
                          
                     }else{?>
                     <script>
                       window.location="login.php";    
                    </script>
                     
                     <?php    
                     }
                        
                 }
              
            
    
            ?> 
            <script>
                //$cart_state is the the db_insert_orders
                var estado_carro='<?php echo $cart_state;?>';
               // alert(estado_carro);
               if(estado_carro=="done"){
                   document.getElementById("formulario").style.display="none";
                  // <div id="resultado">
                   document.getElementById("resultado").innerHTML="Your order has done correctly";
                   itemsArray=[];
                    localStorage.setItem("item",JSON.stringify(itemsArray));
               }else{
                document.getElementById("resultado").innerHTML="Something wrong";
               }
                
            </script>         
    
        <style>
            
           
            form{
                width: 360px; 
                margin:auto; 
                margin-top:100px;
            }
            
            .priceList,.items{
                pointer-events: none; /* desactivamos el la modificacion del input */
            }
            input{
                color:#665b2a;
                font-size:17px;
                width:160px;
                height:30px;
                background-color:#fff;
                border:0;
             }
             select{
                height:30px;
                color:#665b2a;
                font-size:17px;
             }

             #buy{
                color:honeydew;
                font-size:18px;
                width:185px; 
                height:30px;
                background-color:#a09357;
                 border:0;                

             }
                   

         </style>
       
         
     
       <!-- <"?php endif; ?>-->
        </main>
       
       
    </body>
    <?php include('footer.php');

        clearstatcache();
    ?>
</html>
 