<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <?php

    $array = array(
        "Chama Gaucha" => 40.50,
        "Aviva by kameel" => 15.00,
        "Bone's Restuarant" => 65.00,
        "Umi Sushi Buckhead" => 40.50,
        "Fandangles" => 30.00,
        "Capital Grille" => 60.50,
        "Canoe" => 35.50,
        "One Flew South" => 21.00,
        "Foz Bros.BBQ" => 15.00,
        "South City Kitchen Midtown" => 29.00,

    );

    echo "<h1> Top 10 Restuarants in Atlanta </h2>";

    echo "<table style=\"width: 100%; \">";
    echo "<tr>";
    echo "<th> Resturant </th>";
    echo "<th> Average Cost </th>";
    echo "</tr>";

    foreach (array_keys($array) as $key) {
        echo "<tr>";
        echo "<td> $key </td>";
        echo "<td> $array[$key] </td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>