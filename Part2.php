<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

echo "<table cellpadding='1' cellspacing='1' style=\"width: 300px;border:1px \">";
$c = "red";

for ($i=0; $i < 8; $i++) { 
    echo "<tr>";

    for ($j=0; $j < 8; $j++) { 
        echo "<td height='35px' width='35px' bgcolor=$c></td>";
        if ($c == "red") {
            $c = "black";
        }
        else{
            $c = "red";
        }
    }
    echo "</tr>";
    if ($c == "red") {
        $c = "black";
    }
    else{
        $c = "red";
    }
}
?>
    
</body>
</html>