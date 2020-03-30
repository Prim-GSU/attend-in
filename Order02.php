<!DOCTYPE html>
<html>
   <head>
      <title>Validation Confirm</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">

   </head>
   <body>
      <div class="pageContainer centerText">
         <?php
         include 'Order03.php';

         //Retrieve inputs (using helper function)
         $fname = $_GET['fname'];
         $carModel = $_GET['model'];

 //set validation flag
 $IsValid = true;

 echo "<p class='centeredNotice'>";

         if (!fIsValidLength($fname, 2, 20)) {
            echo "Enter first name (2-20 characters)<br>";
            $IsValid = false;
         }

         







         echo "</p>";
         if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "Invalid input";
            //stop execution. 
            exit();
         }

         //all inputs are valid. 
         echo "<div class='center'>
         First Name: $fname <br>
         Car Model: $model <br>
         ";
        
         