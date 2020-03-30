<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    function isBitten()
    {
        $r = rand(0, 1); //50% chances for getting one or zero which is true or false
        if ($r == 1) {
            return true;
        } else {
            return false;
        }
    }
    $result = isBitten();
    if ($result == true) {
        echo "Charlie ate my lunch";
    } else {
        echo "Charlie did not eat my lunch";
    }


    ?>
</body>

</html>