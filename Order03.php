<?php
function fIsValidLength($input, $minLength, $maxLength) {
    //returns true of false
    //trim empty spaces from beginning and end
    $input = trim($input);
    $IsValid = (strlen($input) >= $minLength && strlen($input) <= $maxLength);
    return $IsValid;
 }
 





?>