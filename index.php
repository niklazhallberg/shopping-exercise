<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kristi|La+Belle+Aurore|Mr+De+Haviland" rel="stylesheet">

    <title>_botanica_Studio_HELLO</title>
</head>

<body>
 
 <!-- ROLLING TEXTs ON TOP OF SCREEN, WITH WEEKDAY-CAMPAIGN INFORMATION -->
  
   <?  if (date("l")  == "Monday"){
    
            echo "<div class='marquee'>";
            echo "<marquee behavior='scroll' direction='left'><br><b>Monday discount</b>___ Enjoy 50% discount on all prints___!!!
            </marquee>";
            echo "</div>";
    
        } else if (date("l")  == "Wednesday"){
    
    
            echo "<div class='marquee'>";
            echo "<marquee behavior='scroll' direction='left'><br><b>Wednesday extra</b>___ Today we add 10% on the regular price in contribution to Botanica Life Foundation ___!!!
            </marquee>";
            echo "</div>";
    
        } else if (date("l")  == "Friday"){
    
            echo "<div class='marquee'>";
            echo "<marquee behavior='scroll' direction='left'><br><b>Friday special</b>___ Enjoy 20 sek discount on all prints over 200 sek___!!!
            </marquee>";
            echo "</div>";
    
        }
        
    ?>
    
    
    <!-- PRESENTATION OF PRODUCTS at STARTPAGE index.php STARTS HERE -->
    
    
    <h1>___botánica_Studio__&#9729;______</h1>
    
    <p class="error_msg"><?php
        
        /* CUSTOMER BLANK FORM ERRORs SHOWS HERE */ 
        
     if (isset($_GET["error"])){
       echo $_GET["error"];
       }
     ?>
     
     </p>
    
    <p class="shop">shop</p>
    
    <div class="container text-center">
    
    <div class="row" role="region">
       
            <?php
        
        /* LOOP OUT ALL PRODUCTS AT index.php USING:

            #1 INDEXED ARRAY    
            #2 ASSOCIATIVE ARRAY
            #3 FOREACH LOOP          */
        
                /* 1 */       
                $all_prints = array("Cremnophila nutans", "Othonna Crassifolia", "Symphoricarpos albus", "Verticillata");
        
        $_SESSION['allprints'] = $all_prints;
        
        /* 2 */ 
        $all_prints = [ 
            
              [
                "name" => "Cremnophila_nutans",
                "price" => "100",
                "image" => "image/blomma1.png"
              ],
              [
                "name" => "Othonna_Crassifolia",
                "price" => "200",
                "image" => "image/blomma2.png"
              ],
              [
              "name" => "Symphoricarpos_albus",
                "price" => "300",
                "image" => "image/blomma3.png"
              ],
              [
              "name" => "Verticillata",
                "price" => "400",
                "image" => "image/blomma4.png"
              ]
  
        ];
                        
?>
            
            
          <?php 
        
             /* 3 */ 
              foreach($all_prints as $single_print): ?>
            
            <div class="col-12 flower_box">
              
               <img src="<?= $single_print["image"]; ?>" class="img-fluid" alt="Responsive image"/>
               <p><?= $single_print["name"]; ?></p>
               <p><?= $single_print["price"]; ?> sek</p>
               
            </div>
                
                 <label for="quantity" class="label_qty">Qty &nbsp;</label> <input class="qtybox" id="quantity" name="quantity<?= $single_print["name"]?>" type="number" placeholder= "0" form="form1"/>

                <?php endforeach; ?>
                
                <?php 
                
                /* CREATING SESSIONS OF INDEX ARRAYS FOR CHECKOUT.php */
                
                $_SESSION['Cremnophila_nutans_price'] = $all_prints[0]['price']; 
                $_SESSION['Othonna_Crassifolia_price'] = $all_prints[1]['price'];
                $_SESSION['Symphoricarpos_albus_price'] = $all_prints[2]['price'];
                $_SESSION['Verticillata_price'] = $all_prints[3]['price'];
                ?>
                   
                    
                </div>
            
    <div class="contactform">
    
    <p class="Customer_info"><b>Fill form below :)</b></p>
    
    <!-- CUSTOMER INFORMATION FORM before CHECKOUT -->
    
    <form action="checkout.php" method="POST" class="form" id="form1">
        <label for="register_username">Username</label>
        <input type="text" name="username" id="register_username">
        <label for="register_password">Password</label>
        <input type="password" name="password" id="register_password">
        <label for="firstName">First name: </label>
        <input id="firstName" type="text" name="firstName" /><br>
        <label for="lastName">Last name: </label>
        <input id="lastName" type="text" name="lastName"/><br>
        <label for="Adress">Adress: </label>
        <input id="Adress" type="text" name="Adress"/><br>
        <label for="ZipCode">Zipcode: </label>
        <input id="ZipCode" type="text" name="ZipCode"/><br>
        <label for="Phone">Phone: </label>
        <input id="Phone" type="tel" name="Phone" /><br>
        <label for="Mail">Mail: </label>
        <input id="Mail" type="email" name="Mail" /><br>
        <input type="submit" value="Checkout"/> 
    </form>
    

</div>
   
</div> <!-- CONTAINER STOPS HERE -->
   
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>

</html>