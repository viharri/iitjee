<?php
/**
 * Birthday Test Script
 * to manually check something
 */
// regno d m y
include "Snoopy.class.php";
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$url = "http://192.168.216.1/viewapp/index.php";
$file = file("export.csv");
foreach($file as $line){
	$people = explode(',',trim($line));//regno,name , air, catrank, cat, form_no, date
	if($people[0]!='"'.$argv[1].'"') continue;
	$form = array();
	$form['appln_no']=substr($people[5],1,-1);
	$form['regn_no']=substr($people[0],1,-1);
	$form['proceed']='Proceed';
	$form['day'] = $argv[2];
	$form['month'] = $argv[3];
	$form['year'] = $argv[4];
	print_r($form);
	if(check($form))
		echo "YES\n";
}


function check($form){
	global $snoopy,$url;
	$snoopy->submit($url,$form);
	print_r($snoopy);
	if(substr($snoopy->lastredirectaddr,-8)=='home.php')
		return true;
	else
		return false;
}
