<?php

function checkHash($token) {
	
	//get hash from query
	$md5_hash = $_GET['md5_hash'];
	
	//get time from query
	$time = $_GET['hashtime'];
	
	//concatenate token & time
	$concat = $time.$token;
	
	//hash the concatenation
	$hash = md5($concat);
	
	if($hash == $md5_hash) {
		return TRUE;
	} else {
		return FALSE;
	}
}
?>