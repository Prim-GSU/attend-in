<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1> Henry Fav Restaurant </h1>
  <h2> Order Results </h2>


  <?php

  date_default_timezone_set("America/New_York");
  echo "Order processed at " . date('H:i, jS F Y '); //date("h:i, d m Y");
  echo "<br>";
  echo "<br>";

  echo "Your order is as follows:";
  echo "<br>";
  echo "<br>";


  echo "Plates Ordered:" . ($_POST['Plate1'] + $_POST['Plate2'] + $_POST['Plate3'])."<br>";
  $Quantity = $_POST['Plate1'] + $_POST['Plate2'] + $_POST['Plate3'];

  if ($Quantity == 0) {
    echo "You did not order anything on the previous page!". "<br>";
    
  }


  $Subtotal = ($_POST['Plate1'] * 2100 + $_POST['Plate2'] * 199 + $_POST['Plate3'] * 899);
  echo "Subtotal:$" . ($Subtotal)."<br>";

  $Including_tax = $Subtotal + $Subtotal * (0.1);
  $float_value_of_Including_tax=floatval($Including_tax);
 
  echo "Total including tax:$". $float_value_of_Including_tax . "<br>";
  
  echo "<br>";
  echo "<br>";

  $array= array(
    "a"=> "Google",
    "b"=> "Web ad",
    "c"=> "TV ad",
    "d"=> "Word of mouth",

  );
 
echo "Customer referred by  ". $array[$_POST['find']] .".";

  ?>





</body>

</html>