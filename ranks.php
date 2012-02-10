<?php
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 (.NET CLR 3.5.30729)";
$snoopy->rawheaders["Pragma"] = "no-cache";
//$link='http://jee.iitm.ac.in/counseling/marks/iitd/index.php';
$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
if(!$db)
	die("death");
$q="SELECT distinct(course) FROM results where cat='PD' and course <> 'Not Allotted' order by rank desc";
$res=mysqli_query($db,$q);
//echo "<table>";
while($row=mysqli_fetch_row($res))
{
	$code=substr($row[0],0,4);
	//First For General
	$qu="SELECT count(*), max(catrank), min(catrank) FROM results WHERE CAT ='ST' AND course like'$code%'";
	$res2=mysqli_query($db,$qu);
	$ans=mysqli_fetch_row($res2);
	echo $code.'----'.$ans[0].'----'.$ans[1].'----'.$ans[2]."<BR>";
}
function cut_str($str, $left, $right) { $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
 } 
 ?>