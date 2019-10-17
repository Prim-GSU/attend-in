<!DOCTYPE text/plain>
<?php
require_once "Database.php";
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$function = $_GET['function'];
//console_log("test", false);

//Instead of a switch statement, we can use a try catch block with the name of the function used as variable
try{
    $function();
}
catch(Throwable $e){
    //This will exit if there's no "function" key in the query string or if the function in the query string doesn't exist
    echo $e->getMessage();
    exit;
}

function md5Hash(){
    return true;
}

function student_first_login(){
    //check to see if username exists first.
    //If it exists, return a null student
    $username = $_GET['loginid'];
    $student = getStudentByLoginid($loginid);
    if($student->get_tid() != null){
        $student = new Student(null, null, null, null, null);
    }
    //Otherwise, insert and return a new student
    else{
        $student = new Student(0, 
        $_GET['loginid'],
        $_GET['last_name'],
        $_GET['first_name'],
        $_GET['token']
        );
        //echo (json_encode($student->jsonSerialize()));
        $student = insertStudent($student);
    }
    echo (json_encode($student->jsonSerialize()));
}

function professor_first_login(){
    //check to see if username exists first.
    //If it exists, return a null Professor
    $loginid = $_GET['loginid'];
    $professor = getProfessorByLoginid($loginid);
    if($professor->get_id() != null){
        $professor = new Professor(null, null, null, null, null, null);
    }
    //Otherwise, insert and return a new Professor
    else{
        $professor = new Professor(0, 
        $_GET['loginid'],
        $_GET['title'],
        $_GET['last_name'],
        $_GET['first_name'],
        $_GET['token']
        );
        //echo (json_encode($student->jsonSerialize()));
        $professor = insertProfessor($professor);
    }
    echo (json_encode($professor->jsonSerialize()));
}


function get_student_by_tid(){
    $tid = $_GET['tid'];
    //$student = new Student($tid, null, null, null, null);
    $student = getStudentByTid($tid);
    echo (json_encode($student->jsonSerialize()));
}


//echo (json_encode($result). "\n") ;
//echo "\nI'm still running, though!\n";

//?function=student_first_login&login_id=sfassnacht1&username=what_is_this&last_name=fassnacht&first_name=steven&token=fuzzywuzzy
?>
