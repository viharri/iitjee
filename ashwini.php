<?php
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
$file = file('ashwini.htm');
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$snoopy->rawheaders["Pragma"] = "no-cache";
$centers_per_zone = array(19,16,14, 12,26, 22,22);//Starts from 1
$db = new mysqli("localhost","root","nemoabhay","iitjee");
$count = count($file);
foreach($file as $ln=>$line)
{
  $reg_no = trim(substr($line,0,7));
  if(ctype_digit($reg_no))
  {
	$result_mini=$db->query("SELECT data from results_2011_raw where regno = '$reg_no'");
	if($result_mini)
	  if($result_mini->num_rows>0)
		{$data=$result_mini->fetch_row();if(strlen($data[0])) continue;}
	echo $ln."/".$count."\r";
	$form['regno'] = $reg_no;
	$form['submit'] = "Submit";
	$snoopy->submit("http://192.168.216.1/resultstatus.php",$form);
	if(strpos($snoopy->results,'is invalid')!==false){
		echo "Invalid.";
		continue;
	}
	else{
		$result = trim(strip_tags(cut_str($snoopy->results,'<p><br />','<p class="content">')));
		if(strpos($snoopy->results,"NOT Qualified")!==false){
			//Did not qualify
			continue;
		}
		else{
			//Maybe qualified
			//save
			$res = $db->escape_string($result);
			$db->query("INSERT INTO results_2011_raw VALUES ('$reg_no','$res')");
		}
	}
  }
}
function cut_str($str, $left, $right) {
 $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
}
