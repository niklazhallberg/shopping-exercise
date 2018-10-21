<?php
session_start();

/* WEEKDAY PRICE CORRECTION LOGIC */

/* NOTE: CODE FOR WEEKDAY PRICE CORRECTION IS CURRENTLY 'OK' IN RELATION TO THIS SMALL TASK, WITH ONLY 4 PRODUCTS. IN OTHER CASE, WITH LAGER AMOUNT OF PRODUCTS, LOOPS WOULD HAVE BEEN MORE EFFICIENT */

 if (date("l")  == "Monday"){
     
     function divPrice($print_price){
         $print_price = $print_price / 2;
         return $print_price;
     }
     
     $_SESSION['Cremnophila_nutans_price'] =  divPrice($_SESSION['Cremnophila_nutans_price']);
     $_SESSION['Othonna_Crassifolia_price'] =  divPrice($_SESSION['Othonna_Crassifolia_price']);
     $_SESSION['Symphoricarpos_albus_price'] =  divPrice($_SESSION['Symphoricarpos_albus_price']);
     $_SESSION['Verticillata_price'] =  divPrice($_SESSION['Verticillata_price']);
     
     
     
        } else if (date("l") == "Wednesday"){
     
     function addPrice($print_price){
         $print_price = $print_price * 1.1;
         return $print_price;
     }
     
     $_SESSION['Cremnophila_nutans_price'] =  addPrice($_SESSION['Cremnophila_nutans_price']);
     $_SESSION['Othonna_Crassifolia_price'] =  addPrice($_SESSION['Othonna_Crassifolia_price']);
     $_SESSION['Symphoricarpos_albus_price'] =  addPrice($_SESSION['Symphoricarpos_albus_price']);
     $_SESSION['Verticillata_price'] =  addPrice($_SESSION['Verticillata_price']);
     
     
        } else if (date("l") == "Friday"){
    
         function subPrice($print_price){
         $print_price = $print_price - 20;
         return $print_price;
        }
     
            if ($_SESSION['Cremnophila_nutans_price'] > 200){
                $_SESSION['Cremnophila_nutans_price'] = subPrice($_SESSION['Cremnophila_nutans_price']);
                } 

            if ($_SESSION['Othonna_Crassifolia_price'] > 200){
                $_SESSION['Othonna_Crassifolia_price'] = subPrice($_SESSION['Othonna_Crassifolia_price']);
                } 
            if ($_SESSION['Symphoricarpos_albus_price'] > 200){
                $_SESSION['Symphoricarpos_albus_price'] = subPrice($_SESSION['Symphoricarpos_albus_price']);
                } 
            if ($_SESSION['Verticillata_price'] > 200){
                $_SESSION['Verticillata_price'] = subPrice($_SESSION['Verticillata_price']);
                } 
     }

/* CUSTOMER BLANK FORM ERRORs */

if (empty($_POST["firstName"] )){
    header('Location: /index.php?error=<b>Oups! You forgot to enter your firstname :(</b>');
}
 else if (empty($_POST["lastName"])){
    header('Location: /index.php?error=Oups! You forgot to enter your lastName :(');

} else if (empty($_POST["Adress"])){
    header('Location: /index.php?error=Oups! You forgot to enter your adress :(');
    
} else if (empty($_POST["ZipCode"])){
    header('Location: /index.php?error=Oups! You forgot to enter your zipcode :(');
    
} else if (empty($_POST["Phone"])){
    header('Location: /index.php?error=Oups! You forgot to enter your phone number :(');
    
} else if (empty($_POST["Mail"])){
    header('Location: /index.php?error=Oups! You forgot to enter your mail! :(');
     
     
/* AND IF CUSTOMER DO NOT CHOOSE any QUANTITY of PRINT */ 
     
} else if (empty($_POST["quantityCremnophila_nutans"]) && empty($_POST["quantityOthonna_Crassifolia"]) && empty($_POST ["quantitySymphoricarpos_albus"]) && empty($_POST["quantityVerticillata"])){
    header('Location: /index.php?error=Please choose a print and then go to checkout!');
}

?>

<!-- HTML CODE for CHECKOUT.php starts here --> 

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kristi|La+Belle+Aurore|Mr+De+Haviland" rel="stylesheet">
    <title>_botanica_Studio_CHECKOUT</title>
</head>

<body>

    <div class="container text-center">

        <div class="row" role="region">

            <div class="col-12 information_box">
                       

<!-- PRESENTATION OF CUSTOMER BILLING INFO -->
               
               <h1 class="h1Checkout">___botánica_Studio__&#9729;______</h1>
               <p class="PersonalBox">Personal information and billing adress</p>

        <?  if(isset($_POST["firstName"])){
                $_SESSION["firstName"] = $_POST ["firstName"];
			    echo $_SESSION["firstName"] . "<br>";
            }
    
            if(isset($_POST["lastName"])){
                $_SESSION["lastName"] = $_POST ["lastName"];
			    echo $_SESSION["lastName"] . "<br>";
            }
        
            if(isset($_POST["Adress"])){
                $_SESSION["Adress"] = $_POST ["Adress"];
			    echo $_SESSION["Adress"] . "<br>";
            }
            
            if(isset($_POST["ZipCode"])){
                $_SESSION["ZipCode"] = $_POST ["ZipCode"];
			    echo $_SESSION["ZipCode"] . "<br>";
            }
                
            if(isset($_POST["Phone"])){
                $_SESSION["Phone"] = $_POST ["Phone"];
			    echo $_SESSION["Phone"] . "<br>";
            }
                    
            if(isset($_POST["Mail"])){
                $_SESSION["Mail"] = $_POST ["Mail"];
			    echo $_SESSION["Mail"] . "<br>";
            }
    
?>

            <div class="col-12">

                <p class="ChoiceText"> Your current choice of prints: </p>          

    <?php
                
     /* CREATE LOOP AND ARRAY FOR EACH PRODUCTs AND SET PRODUCT TOTAL COST FOR EACH to int 0 */
                
        $TotPerPrints = new SplFixedArray(count($_SESSION['allprints']));
                
        for($i=0;$i<count($TotPerPrints);$i++){
            $TotPerPrints[$i] = 0;
        }
                
     /* CALCULATION AND ECHO OF PRODUCT, QTY, PRICE AND TOTAL SUM */
                
        if(is_numeric($_POST["quantityCremnophila_nutans"])){
        $_SESSION["quantityCremnophila_nutans"] = $_POST["quantityCremnophila_nutans"];
            
        $TotPerPrints[0] = ($_SESSION['Cremnophila_nutans_price'] * $_SESSION["quantityCremnophila_nutans"]);
        
        echo ' Cremnophila nutans ' . ' __ ' . $_SESSION['Cremnophila_nutans_price'] . ' sek/pcs ' . ' __ ' . $_SESSION["quantityCremnophila_nutans"] . ' pcs ' . ' __ ' . ' sum: ' . $TotPerPrints[0] . ' sek ' . "<br>";
            ;
            
        }
                
        if(is_numeric($_POST["quantityOthonna_Crassifolia"])){
        $_SESSION["quantityOthonna_Crassifolia"] = $_POST ["quantityOthonna_Crassifolia"];
        
         $TotPerPrints[1] = ($_SESSION['Othonna_Crassifolia_price'] * $_SESSION["quantityOthonna_Crassifolia"]);
        echo ' Othonna Crassifolia ' . ' __ ' . $_SESSION['Othonna_Crassifolia_price'] . ' sek/pcs ' . ' __ ' . $_SESSION["quantityOthonna_Crassifolia"] . ' pcs ' . ' __ ' . ' sum: ' .  $TotPerPrints[1] . ' sek ' . "<br>";
            
        }
            
        if(is_numeric($_POST["quantitySymphoricarpos_albus"])){
        $_SESSION["quantitySymphoricarpos_albus"] = $_POST ["quantitySymphoricarpos_albus"];
            
         $TotPerPrints[2] = ( $_SESSION['Symphoricarpos_albus_price'] * $_SESSION["quantitySymphoricarpos_albus"]);
        echo ' Symphoricarpos albus ' . ' __ ' .  $_SESSION['Symphoricarpos_albus_price'] . ' sek/pcs ' . ' __ ' . $_SESSION["quantitySymphoricarpos_albus"] . ' pcs ' . ' __ ' . ' sum: ' .  $TotPerPrints[2] . ' sek ' . "<br>";
            
        }
            
        if(is_numeric($_POST["quantityVerticillata"])){
        $_SESSION["quantityVerticillata"] = $_POST ["quantityVerticillata"];
            
        $TotPerPrints[3] = ($_SESSION['Verticillata_price'] * $_SESSION["quantityVerticillata"]);
        echo ' Verticillata ' . ' __ ' . $_SESSION['Verticillata_price'] . ' sek/pcs ' . ' __ ' . $_SESSION["quantityVerticillata"] . ' pcs ' . ' __ ' . ' sum: ' .  $TotPerPrints[3] . ' sek ' . "<br>" . "<br>";
            
        }
                
    
        /* CREATE LOOP FOR CALCULATION OF TOTAL SUM */
              
        $totalsum = 0;

        for($i=0;$i<count($TotPerPrints);$i++){
            $totalsum = $totalsum + $TotPerPrints[$i];
        }    
    
            echo ' <b>Total sum: ' . $totalsum . ' sek </b>'. "<br>" . "<br>"; 
                
    ?>
           
            <form action="ThankYou.php" method="POST" class="form" id="form2">
            <input type="submit" value="Confirm Order"/> 
            </form> 

           
            </div> <!-- Your current choice of prints BOX STOPS HERE -->

        </div> <!-- COL-12 informationbox STOPS HERE -->

    </div> <!-- ROW CLASS STOPS HERE -->
     
    </div> <!-- CONTAINER DIV STOPS HERE -->
    
    <div class="purple_footer"></div>

</body>

</html>
