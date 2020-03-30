<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  function hello_world() {
    echo "Question 1";
    echo "<h1> Hello World </h1>";
  }
  
  function nested_loops(){
    echo "<h1>Nested loops </h1>";
    for($x=1;$x<=5;$x++){
      for ($y=1; $y <= $x; $y++) { 
        echo "*";
      }
      echo "<br/>";
    }
  }

  function triangle($n){
    echo "<h1>triangle function</h1>";
    for($x=1;$x<=$n;$x++){
      for ($y=1; $y <= $x; $y++) { 
        echo"*";
      }
      echo "<br/>";
    } 
  }
  function word_count($scentence){

    echo "<h1>WordCount</h1>";
    $wc = 0;
    for($i=0;$i<strlen($scentence);$i++){
      if ($scentence[$i] ==" "){
        $wc = $wc + 1;
      }

    }
    $wc = $wc + 1;
    echo"$wc";
  }

  function countWords($str){
    echo "<h1>CountWord</h1>";
    //$count_word = array();
    //$words = explode(" ",$str);
    //foreach($words as $word){
      $str = 'WebPrograMMing';
      $str = str_replace(' ', '', $str);
      $arr = str_split($str);
      
      $rep = array_count_values($arr);
      
      foreach ($rep as $key => $value) {
      
      echo $key . "  =  " . $value . '<br>';
      
      }
    }


  function remove_all($str, $c){
    $str_new = "";
    for ($i=0; $i < strlen($str); $i++) { 
      if($str[$i] != $c){
        $str_new = $str_new.$str[$i];
      }
    }
    echo "<h2> New String: $str_new </h2>";
  }


  hello_world();
  nested_loops();
  triangle(7);
  word_count("hello, how are you?");
  countWords("WebPrograMMing");
  remove_all("Summer is here!",'e');


  ?>

</body>

</html>