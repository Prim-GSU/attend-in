<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
   
  echo"<h1> Printing months in order </h1>";
$month = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December');
for ($x = 0; $x <= 11; $x++) {
echo "$month[$x]. ";


}
echo"<br>";

echo"<h1> Printing months alphabetic order </h1>";
$month = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December');
sort($month);
for ($x = 0; $x <= 11; $x++) {
echo "$month[$x]. ";

}
echo"<br>";

echo"<h1> Printing months in order using foreach </h1>";
$month = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December');
foreach ($month as &$val) {
echo "$val. ";
}
echo"<br>";

echo"<h1> Printing months in alphabetic order using foreach </h1>";
$month = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December');
sort($month);
foreach ($month as &$val) {
echo "$val. ";
}
echo"<br>";












   ?>
</body>
</html>