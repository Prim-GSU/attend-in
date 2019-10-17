<?php

/*Logging function*/
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');<br>';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

class Student implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $loginid;
	public function set_loginid($loginid){$this->loginid =  $loginid;}
	public function get_loginid(){return $this->loginid;}
	private $lastname;
	public function set_lastname($lastname){$this->lastname =  $lastname;}
	public function get_lastname(){return $this->lastname;}
	private $firstname;
	public function set_firstname($firstname){$this->firstname =  $firstname;}
	public function get_firstname(){return $this->firstname;}
	private $token;
	public function set_token($token){$this->token =  $token;}
	public function get_token(){return $this->token;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->loginid = func_get_arg(1);}
		if(func_get_arg(2)){$this->lastname = func_get_arg(2);}
		if(func_get_arg(3)){$this->firstname = func_get_arg(3);}
		if(func_get_arg(4)){$this->token = func_get_arg(4);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Professor implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $loginid;
	public function set_loginid($loginid){$this->loginid =  $loginid;}
	public function get_loginid(){return $this->loginid;}
	private $title;
	public function set_title($title){$this->title =  $title;}
	public function get_title(){return $this->title;}
	private $lastname;
	public function set_lastname($lastname){$this->lastname =  $lastname;}
	public function get_lastname(){return $this->lastname;}
	private $firstname;
	public function set_firstname($firstname){$this->firstname =  $firstname;}
	public function get_firstname(){return $this->firstname;}
	private $token;
	public function set_token($token){$this->token =  $token;}
	public function get_token(){return $this->token;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->loginid = func_get_arg(1);}
		if(func_get_arg(2)){$this->title = func_get_arg(2);}
		if(func_get_arg(3)){$this->lastname = func_get_arg(3);}
		if(func_get_arg(4)){$this->firstname = func_get_arg(4);}
		if(func_get_arg(5)){$this->token = func_get_arg(5);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Course implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $courseid;
	public function set_courseid($courseid){$this->courseid =  $courseid;}
	public function get_courseid(){return $this->courseid;}
	private $coursename;
	public function set_coursename($coursename){$this->coursename =  $coursename;}
	public function get_coursename(){return $this->coursename;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->courseid = func_get_arg(1);}
		if(func_get_arg(2)){$this->coursename = func_get_arg(2);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Section implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $courseid;
	public function set_courseid($courseid){$this->courseid =  $courseid;}
	public function get_courseid(){return $this->courseid;}
	private $professorid;
	public function set_professorid($professorid){$this->professorid =  $professorid;}
	public function get_professorid(){return $this->professorid;}
	private $section;
	public function set_section($section){$this->section =  $section;}
	public function get_section(){return $this->section;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->courseid = func_get_arg(1);}
		if(func_get_arg(2)){$this->professorid = func_get_arg(2);}
		if(func_get_arg(3)){$this->section = func_get_arg(3);}
		if(func_get_arg(4)){$this->professorid = func_get_arg(4);}
		if(func_get_arg(5)){$this->courseid = func_get_arg(5);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Roll implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $sectionid;
	public function set_sectionid($sectionid){$this->sectionid =  $sectionid;}
	public function get_sectionid(){return $this->sectionid;}
	private $studentid;
	public function set_studentid($studentid){$this->studentid =  $studentid;}
	public function get_studentid(){return $this->studentid;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->sectionid = func_get_arg(1);}
		if(func_get_arg(2)){$this->studentid = func_get_arg(2);}
		if(func_get_arg(3)){$this->sectionid = func_get_arg(3);}
		if(func_get_arg(4)){$this->studentid = func_get_arg(4);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Login implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $rollid;
	public function set_rollid($rollid){$this->rollid =  $rollid;}
	public function get_rollid(){return $this->rollid;}
	private $ipaddress;
	public function set_ipaddress($ipaddress){$this->ipaddress =  $ipaddress;}
	public function get_ipaddress(){return $this->ipaddress;}
	private $latitude;
	public function set_latitude($latitude){$this->latitude =  $latitude;}
	public function get_latitude(){return $this->latitude;}
	private $longitude;
	public function set_longitude($longitude){$this->longitude =  $longitude;}
	public function get_longitude(){return $this->longitude;}
	private $verifycode;
	public function set_verifycode($verifycode){$this->verifycode =  $verifycode;}
	public function get_verifycode(){return $this->verifycode;}
	private $logindate;
	public function set_logindate($logindate){$this->logindate =  $logindate;}
	public function get_logindate(){return $this->logindate;}
	private $result;
	public function set_result($result){$this->result =  $result;}
	public function get_result(){return $this->result;}
	private $token;
	public function set_token($token){$this->token =  $token;}
	public function get_token(){return $this->token;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->rollid = func_get_arg(1);}
		if(func_get_arg(2)){$this->ipaddress = func_get_arg(2);}
		if(func_get_arg(3)){$this->latitude = func_get_arg(3);}
		if(func_get_arg(4)){$this->longitude = func_get_arg(4);}
		if(func_get_arg(5)){$this->verifycode = func_get_arg(5);}
		if(func_get_arg(6)){$this->logindate = func_get_arg(6);}
		if(func_get_arg(7)){$this->result = func_get_arg(7);}
		if(func_get_arg(8)){$this->token = func_get_arg(8);}
		if(func_get_arg(9)){$this->rollid = func_get_arg(9);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class Verify implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $sectionid;
	public function set_sectionid($sectionid){$this->sectionid =  $sectionid;}
	public function get_sectionid(){return $this->sectionid;}
	private $verifycode;
	public function set_verifycode($verifycode){$this->verifycode =  $verifycode;}
	public function get_verifycode(){return $this->verifycode;}
	private $datetimeset;
	public function set_datetimeset($datetimeset){$this->datetimeset =  $datetimeset;}
	public function get_datetimeset(){return $this->datetimeset;}
	private $token;
	public function set_token($token){$this->token =  $token;}
	public function get_token(){return $this->token;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->sectionid = func_get_arg(1);}
		if(func_get_arg(2)){$this->verifycode = func_get_arg(2);}
		if(func_get_arg(3)){$this->datetimeset = func_get_arg(3);}
		if(func_get_arg(4)){$this->token = func_get_arg(4);}
		if(func_get_arg(5)){$this->sectionid = func_get_arg(5);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

class SetCourse implements \JsonSerializable{
	private $tid;
	public function set_tid($tid){$this->tid =  $tid;}
	public function get_tid(){return $this->tid;}
	private $sectionid;
	public function set_sectionid($sectionid){$this->sectionid =  $sectionid;}
	public function get_sectionid(){return $this->sectionid;}
	private $professorid;
	public function set_professorid($professorid){$this->professorid =  $professorid;}
	public function get_professorid(){return $this->professorid;}
	private $classset;
	public function set_classset($classset){$this->classset =  $classset;}
	public function get_classset(){return $this->classset;}
	private $verifycode;
	public function set_verifycode($verifycode){$this->verifycode =  $verifycode;}
	public function get_verifycode(){return $this->verifycode;}
	public function __construct(){
		if(func_get_arg(0)){$this->tid = func_get_arg(0);}
		if(func_get_arg(1)){$this->sectionid = func_get_arg(1);}
		if(func_get_arg(2)){$this->professorid = func_get_arg(2);}
		if(func_get_arg(3)){$this->classset = func_get_arg(3);}
		if(func_get_arg(4)){$this->verifycode = func_get_arg(4);}
		if(func_get_arg(5)){$this->sectionid = func_get_arg(5);}
		if(func_get_arg(6)){$this->professorid = func_get_arg(6);}
	}
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
	}
}

?>