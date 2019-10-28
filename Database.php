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


function dbFlush(){
    global $db;
    do{
        if ($res = $db->store_result()) {
          $res->free();
        }
    } while ($db->more_results() && $db->next_result());
}

function insertStudent($student){
    global $db;
    dbFlush();
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
    $query = 'CALL getStudentByTid(\'' . $tid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Student($tid, $row[0], $row[1], $row[2], $row[3]);
    }
    return new Student(null, null, null, null, null);
}

function getProfessorByTid($tid){
    global $db;
    $query = 'CALL getProfessorByTid(\'' . $tid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Student($tid, $row[0], $row[1], $row[2], $row[3], $row[4]);
    }
    return new Student(null, null, null, null, null, null);    
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

/*function getStudentByTid($tid){
    global $db;
    $query = 'CALL getSutdentByTid(\'' . $tid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Student($tid, $row[0], $row[1], $row[2], $row[3]);
    }
    return new Student(null, null, null, null, null);
}
*/

function getProfessorByLoginid($loginid){
    global $db;
    $query = 'CALL getProfessorByLoginid(\'' . $loginid .'\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        return new Professor($tid, $row[0], $row[1], $row[2], $row[3], $row[4]);
    }
    return new Professor(null, null, null, null, null, null);
}

function getClassListByProfessorTid($tid){
    global $db;
    dbFlush();
    $ret = array();
    $query = 'CALL getClassListByProfessorTid(\'' . $tid . '\')';
    $result = $db->query($query);

    if($result->num_rows > 0){
        while($row = $result->fetch_array()){
            $section = new section($row[0], $row[1], $tid, $row[2]);
            $professor->jsonSerialize();
        }
        $ret[] = $professor;
    }
    else{
        $ret[] = new Professor(null, null, null, null, null, null);
    }
    return $ret;
}

function setClass($tid, $hashtime){
    global $db;
    dbFlush();
    $ret = array();
    $query = 'CALL setClassTime(\'' . $tid . '\')';
    $result = $db-query($query);
    if($result->num_rows > 0){
        $ret['datetime'] = $row[0];
        $ret['verify'] = $row[1];
    }
    else{
        $ret['error'] = 'section mismatch';
    }
    return $ret;
}

function attendanceByClassDate($sectionId, $date){
    global $db;
    dbFlush();
    $ret = array();
    $query = 'CALL attendanceByClassDate(\'' . $tid . '\', \'' . $date . '\')';
    $result = $db-query($query);
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_array()){
            $studentAttendance = new StudentAttendance($row[0], $row[1], $row[2], $row[3]);
            $studentAttendance->jsonSerialize();
            $ret[] = $studentAttendance;
        }
    }
    else{
        $ret['error'] = 'No attendance for that date';
    }
    return $ret;
}
?>

