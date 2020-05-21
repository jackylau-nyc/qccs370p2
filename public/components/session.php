<?php
if(!isset($_SESSION)) { 
    session_start(); 
} 
if(isset($_COOKIE["MinDate"])){ 
    echo "MinDate is " . $_COOKIE["MinDate"]; 
} else{ 
	$div = $doc->getElementById('currentDate');
	if($div) {
	    echo $div->textContent;
	}
    setcookie("MinDate", $div->textContent, time()-60); 
} 
