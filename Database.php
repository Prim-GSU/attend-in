<?php
require 'Classes.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli('localhost', 'attendin_prim', '28836346', 'attendin_test');
if ($db->connect_error) {
    echo 'Failed to connect to MySQL: ' . $db->connect_error;
    $db = NULL;
}



/*Queries*/

/*CREATE*/


function insertStudent($student){
    global $db;
    do {
        if ($res = $db->store_result()) {
          $res->free();
        }
       } while ($db->more_results() && $db->next_result());
    $query = 'CALL addStudent(\'' . $student->get_loginid() . '\',\'' . $student->get_lastname() . '\',\'' . 
        $student->get_firstname() . '\',\'' . $student->get_token() . '\')';    
    $result = $db->query($query);
    $row = $result->fetch_array();
    $student->set_tid($row[0]);
    return $student;
}

/*READ*/
function getStudentByTid($tid){
    global $db;
    $query = 'CALL getStudentbyTid(\'' . $tid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Student($tid, $row[0], $row[1], $row[2], $row[3]);
    }
    return new Student(null, null, null, null, null);
}

function getStudentByLoginid($loginid){
    global $db;
    $query = 'CALL getStudentbyLoginid(\'' . $loginid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Student($tid, $row[0], $row[1], $row[2], $row[3]);
    }
    return new Student(null, null, null, null, null);
}

function getCart($userId){
    global $db;
    $cart;
    $query = "SELECT id, saleComplete from Cart where userid = $userId and saleComplete <> 1";
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        $cart = new Cart($row[0], $userId, $row[1]);
    }
    else{
        $cart = new Cart(-1, $userId, 0);
        $cart = addCart($cart);
    }
    $cart = getCartItems($cart);
    return $cart;
}

/*UPDATE*/
function completeSale($cartId){
    global $db;
    $query = "update Cart set saleComplete = 1 where id = $cartId";
    $db->query($query);
}

/*DELETE*/
function removeSpaceItemFromCart($spaceItemId){
    global $db;
    
    if($spaceItemId > 0){
        $query = "DELETE from Cart where spaceItemId = $spaceItemId";
        $db->query($query);
        $query = "DELETE from SpaceItem where spaceItemId = $spaceItemId";
        $db->query($query);
    }
}
?>

