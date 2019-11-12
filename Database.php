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

function updateStudentToken($student, $token){
    global $db;
    dbFlush();
    $query = 'CALL updateStudentToken(\'' . $student->get_tid() . '\',\'' . $token . '\')';    
    $result = $db->query($query);
    $row = $result->fetch_array();
    $student->set_token($row[0]);
    return $student;    
}

function insertProfessor($professor){
    global $db;
    dbFlush();
    $query = 'CALL addProfessor(\'' . $professor->get_loginid() . '\',\'' . $professor->get_title() . '\',\'' . $professor->get_lastname() . '\',\'' . 
        $professor->get_firstname() . '\',\'' . $professor->get_token() . '\')';    
    $result = $db->query($query);
    $row = $result->fetch_array();
    $professor->set_tid($row[0]);
    return $professor;
}

function updateProfessorToken($professor, $token){
    global $db;
    dbFlush();
    $query = 'CALL updateProfessorToken(\'' . $professor->get_tid() . '\',\'' . $token . '\')';    
    $result = $db->query($query);
    $row = $result->fetch_array();
    $professor->set_token($row[0]);
    return $professor;    
}

/*READ*/
function getStudentByTid($tid){
    global $db;
    dbFlush();
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
        return new Student($row[0], $row[1], $row[2], $row[3], $row[4]);
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
        return new Professor($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
    }
    return new Professor(null, null, null, null, null, null);
}

function getClassListByProfessorTid($tid){
    global $db;
    dbFlush();
    $query = 'CALL getClassListByStudentTid(\'' . $tid . '\')';
    $result = $db->query($query);
    $classList = new ClassList($tid);
    $ret = $classList->get_classObjectList();
    if($result->num_rows > 0){
        while($row = $result->fetch_array()){
            $classListObject = new ClassListObject($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
            //$section->jsonSerialize();
            $ret[] = $classListObject;
        }
    }
    else{
        $ret[] = new Section(null, null, null, null, null, null);
    }
    $classList->set_classObjectList($ret);
    return $classList;
}

function getClassListByStudentTid($tid){
    global $db;
    dbFlush();
    $query = 'CALL getClassListByStudentTid(\'' . $tid . '\')';
    $result = $db->query($query);
    $classList = new ClassList($tid);
    $ret = $classList->get_classObjectList();
    if($result->num_rows > 0){
        while($row = $result->fetch_array()){
            $classListObject = new ClassListObject($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
            //$section->jsonSerialize();
            $ret[] = $classListObject;
        }
    }
    else{
        $ret[] = new Section(null, null, null, null, null, null);
    }
    $classList->set_classObjectList($ret);
    return $classList;
}

function setClass($setCourse){
    global $db;
    dbFlush();
    $ret = array();
    //sectionid, professorid, classset, verifycode
    $query = 'CALL addSetCourse(\'' . $setCourse->get_sectionid() . '\', \'' . $setCourse->get_professorid() . '\', \'' .
        $setCourse->get_classset() . '\', \'' . $setCourse->get_verifycode() . '\')';
    $result = $db->query($query);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        $setCourse->set_tid($row[0]);
        $ret = $setCourse;
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
    $result = $db->query($query);
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

function attendanceByClassDateAndProfId($classId,$profId, $date){
    global $db;
    dbFlush();
    $ret = array();
    $query = 'CALL attendanceByClassDateAndProfId(\'' . $classid . '\',\'' . $profid . '\', \'' . $date . '\')';
    $result = $db->query($query);
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

function addLogin($login){
    global $db;
    dbFlush();
    $query = 'CALL addLogin(\'' . $login->get_rollid() . 
    '\', \'' . $login->get_ipaddress() . 
    '\', \'' . $login->get_latitude() . 
    '\', \'' . $login->get_longitude() . 
    '\', \'' . $login->get_verifycode() . 
    '\', \'' . $login->get_logindate() . 
    '\', \'' . 0 . 
    '\', \'' . $login->get_token() . 
    '\')';
    $result = $db->query($query);
    console_log("query: $query", false);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_array();
        $login->set_tid($row[0]);
        $login->set_result($row[1]);
    }
    else{
        $login->set_result(4);

    }
    // IN _rollid integer,
    // IN _ipaddress varchar(24),
    // IN _latitude float,
    // IN _longitude float,
    // IN _verifycode varchar(40),
    // IN _logindate datetime,
    // IN _result integer,
    // IN _token varchar(40)
    return $login;

}

function getRollidByStudentSection($studentid, $sectionid){
    global $db;
    dbFlush();
    $query = 'CALL getRollidByStudentSection(\'' . $sectionid . '\', \'' . $studentid . '\')';
    $result = $db->query($query);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_array();
        return $row[0];
    }
    else{
        return -1;
    }

}
?>

