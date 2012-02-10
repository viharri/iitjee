<?php
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$snoopy->rawheaders["Pragma"] = "no-cache";
$link='http://jee.iitm.ac.in/counseling/marks/iitd/index.php';
$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
if(!$db)
	die("death");
$q="SELECT * FROM results where course <> 'Not Allotted'";
$res=mysqli_query($db,$q);
while($row=mysqli_fetch_row($res))
{
	$form['Form_No']=$ff=$row[0];
	$name=str_replace(" ","",trim($row[1]));
	$name=substr($name,0,4);
	$form['Form_No'].=$name;
	$form['submit']='Submit';
	//echo $form['Form_No'];
	$link="http://jee.iitm.ac.in/allotcourses/courseallot.php?name=".$form['Form_No'];
	$snoopy->fetch($link,$form);
	//$snoopy->fetch("http://jee.iitm.ac.in/allotcourses/courseallot.php?name=".$ff.$name);
	$page=$snoopy->results;
	//$course='Unalloted due to various reasons<sup>[1]</sup>';
	//echo $page;
	$course=trim(strip_tags(cut_str($page,'Course Allotted','Degree & Institute')));
	if(strlen($course)<3)
		$course='Not Allotted';
	//if($course=='')
	//	$course=strip_tags(cut_str($page,'<font color="#ff0000"><b>','</b></font>'));
	echo "$ff--$name--$course<br>";
	flush();
	$qu="UPDATE results SET course='$course' where reg='$ff'";
	//mysqli_query($db,$qu);
}
function cut_str($str, $left, $right) { $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
 } 
 ?>