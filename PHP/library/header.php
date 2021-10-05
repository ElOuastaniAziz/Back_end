<?php  
        session_start(); //iniciamos la session
        $type =$_SESSION['type'] ?? null;
        $name = $_SESSION['name'] ?? null;
        $e_mail= $_SESSION['email'] ?? null ;
        $id_user= $_SESSION['member_id'] ?? null ;

              //cookie
         //  setcookie("usuario","contac@sdsd.sdsd",time()+84600);
         $cart = [];
         setcookie('cart', 'serialize($cart)', time() + 60*100000, ); 

?>
   <header>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
               <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
               <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
               <link rel="stylesheet" href="/resources/demos/style.css">
               <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
               <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <div class="logo">
                   <a href="index.php"> <img src="images/logo.png" alt="Biblioteca"/></a>
                  
                </div>
                <nav style="margin-right:-465px;">
                    <ul>
                    
                     <!-- If  has login change the Login to logout-->
                        <?php if($type=='usr'){
                     
                           echo '  <li><a href="logout.php">Logout</a></li>';
                           echo '  <li><a href="member.php">Desktop</a></li>';?>
                               
                        <?php
                        }elseif($type=='lib'){
                           echo '  <li><a href="logout.php">Logout</a></li>';
                           echo '  <li><a href="librarian.php">Desktop</a></li>';
                        } else {
                           echo ' <li> <a href="login.php">Login</a></li>';
                           echo ' <li><a href="register.php">Register</a></li>';?>
                           
                        <?php
                        }
                        ;?>  
                          
                      
                    </ul>
                   
                </nav>
                <div style="width:40px;float:left; margin-top:3.4em;"><h5 id="items_quantity"
                 style="color:#fff; width: 10px; margin-left:16px; margin-bottom:-2px;">
                                 <!-- <!?php echo $mis_libros; ?>-->
                  
                                 </h5><a href="cart.php" id="toggleButton"><img src="images/cart.png"
                                  /></a>
            
                        </div> 
              
        </header> 
        <script>                              
            var obj ="";
            var items=[];
           var allitems="";
           var titulo="";
           var precio=0;
            var iden="";
             window.onload = function() {
                     document.getElementById("items_quantity").innerHTML=getLength();
            }
            function Item(id,quantity){
                this.book_id=id;
                this.quantity=quantity;
            }                                     
             function addItem(iden){
               var contadorId=0;
               var number=0;
               if(items.length==0){
                  items.push(iden);
               }else if(items.length>0){
                  for(var i=0;i<items.length;i++){
                     if(items[i]==iden){
                       contadorId++;
                     }
                  } 
                  if(contadorId==0){
                        items.push(iden);     
                  }
               }                  
                //items.push(iden);
               // alert(iden);
               localStorage.setItem("item",JSON.stringify(items));
                var res=localStorage.getItem("item");
                document.getElementById("items_quantity").innerHTML=getLength();
               // alert(res); 
            }
            function getLength(){
             var  allitems=localStorage.getItem("item");
               var obj = JSON.parse(allitems);
                  return obj.length>0 ? obj.length:0;
            }        
    </script>
<?php 

