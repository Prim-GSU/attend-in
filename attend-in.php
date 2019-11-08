<!DOCTYPE text/plain>
<?php
require_once "Database.php";
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$function = $_GET['function'];

//Instead of a switch statement, we can use a try catch block with the name of the function used as variable
try{
    $function();
}
catch(Throwable $e){
    //This will exit if there's no "function" key in the query string or if the function in the query string doesn't exist
    echo $e->getMessage();
    exit;
}

//Utility functions go here - md5Hash is an example. It's used by other functions, not as part of the API
function md5Hash($token){
    return true;
}

function test(){
    foreach ($_GET as $key=> $value){
        $html .= "key = $key, value = $value<br>";
        $req[$key] = $value;
        //$req = $_GET['function'];
    }
    echo (json_encode($html));
    echo (json_encode($req));
}

function get_student_by_tid(){
    $tid = $_GET['student_tid'];
    //$student = new Student($tid, null, null, null, null);
    $student = getStudentByTid($tid);
    echo (json_encode($student->jsonSerialize()));
}


//Student functions go here
function student_first_login(){//First time a student logs in, we need to set the token. This may need to be tweaked
    //check to see if username exists first.
    //If it exists, return a null student
    $loginid = $_GET['loginid'];
    $student = getStudentByLoginid($loginid);
    if($student->get_tid() != null){
        if($student->get_token() != null){
            $student = new student(null, null, null, null, null, null);
        }
        else{
            $student = updateStudentToken($student, $_GET['token']);
        }
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

function student_list(){//Allows the student to retrieve a list of classes, so she can choose which to log in for
    $tid = $_GET['student_tid'];
    $student = getStudentByTid($tid);
    $token = $student->get_token();
    if(!md5Hash($token)){
        $r = array('error' => '3');
    }
    else{
        $r = getClassListByStudentTid($tid);
    }
    echo(json_encode($r));    
}

function student_login(){//Allows the student to mark her attendance for the given class
    $tid = $_GET['student_tid'];
    $student = getStudentByTid($tid);
    $token = $student->get_token();
    if(!md5Hash($token)){
        $r = array('error' => '3');
    }
    else{
        $sectionid = $_GET['class_tid'];
        $rollid = getRollidByStudentSection($tid, $sectionid);
        if($rollid <= 0){
            $r['error'] = 4;
        }
        else{
            $login = new Login(0, $rollid, $_GET['ip_address'], $_GET['latitude'], $_GET['longitude'], '', date('Y-m-d H:i:s'), 4, $token);
            // IN _rollid integer,
            // IN _ipaddress varchar(24),
            // IN _latitude float,
            // IN _longitude float,
            // IN _verifycode varchar(40),
            // IN _logindate datetime,
            // IN _result integer,
            // IN _token varchar(40)
            $login = addLogin($login);
            $r['error'] = $login->get_result();
        }
    }
    echo(json_encode($r));    

}


//Professor functions go here
function professor_first_login(){//First time a professor logs in, we need to set the token. This may need to be tweaked
    //check to see if username exists first.
    //If it exists, check to see if the token exists
    //If it doesn't exist, set the token
    $loginid = $_GET['loginid'];
    $professor = getProfessorByLoginid($loginid);
    echo (json_encode($professor->jsonSerialize()));
    if($professor->get_tid() != null){
        if($professor->get_token() != ''){
            $professor = new Professor(null, null, null, null, null, null);
        }
        else{
            $professor = updateProfessorToken($professor, $_GET['token']);
        }
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


function professor_class_list(){//Retrieve a list of class sections based on professor's tid
    $tid = $_GET['professor_tid'];
    $prof = getProfessorByTid($tid);
    $token = $prof->get_token();
    if(!md5Hash($token)){
        $r = array('error' => '3');
    }
    else{
        $r = getClassListByProfessorTid($tid);
    }
    echo(json_encode($r));    
}

function set_class(){//Mark the class open for attendance login by students
    $professor_tid = $_GET['professor_tid'];
    $prof = getProfessorByTid($professor_tid);
    $token = $prof->get_token();
    if(!md5Hash($token)){
        $r = array('error' => '3');
        echo(json_encode($r));
        exit;
    }
    else{
        $setCourse = new SetCourse(0, $_GET['class_tid'], $professor_tid, date("Y-m-d H:i:s"), null);
        $setCourse = setClass($setCourse);
        //$r = setClass($setCourse);
    }
    try{
        echo(json_encode($setCourse->jsonSerialize()));
    }
    catch(Throwable $t){
        echo(json_encode($setCourse));
    }
}

function attendance_by_date(){//Gives list of students presnt/absent on given date

}

function attendance_by_student(){//Gives list of dates attended by student, missing dates are absences

}

function set_attendance(){//Updates attendance record for given student/class/date

}


//echo (json_encode($result). "\n") ;
//echo "\nI'm still running, though!\n";

//?function=student_first_login&login_id=sfassnacht1&username=what_is_this&last_name=fassnacht&first_name=steven&token=fuzzywuzzy
?>
