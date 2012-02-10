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
$q="SELECT * FROM results where cat='GE' AND catrank='0' AND course <> 'Not Allotted' order by rank desc";
$res=mysqli_query($db,$q);
//echo "<table>";
while($row=mysqli_fetch_row($res))
{
	$form['regno']=$row[0];//.substr(str_replace(" ","",trim($row[1])),0,4);
	//$form['Form_No']=
	$ff=$row[0];
	$form['submit']='Submit';
	//echo $form['Form_No']."<BR>";
	$link="http://jee.iitm.ac.in/resultstatus.php";
	$snoopy->submit($link,$form);
	//var_dump($snoopy->cookies);
	//echo $snoopy->lastredirectaddr."<BR>";
	// $header=$snoopy->headers;
	// $ck['PHPSESSID']=cut_str($header[4],"=",";");
	//echo $ck."<BR>";
	//echo $snoopy->results;
	// $link="http://jee.iitm.ac.in/allotcourses/courseallot.php";
	//echo $link."<BR>";
	//$snoopy->cookies=$ck;
	//$snoopy->fetch($link);
	//$snoopy->fetch("http://jee.iitm.ac.in/allotcourses/courseallot.php?name=".$ff.$name);
	$page=$snoopy->results;
	//$course='Unalloted due to various reasons<sup>[1]</sup>';
	//echo $page;
	//$gen=str_replace(" ","",$gen);
	//$gen=str_replace(":","",$gen);
	$obc=$sc=$st=$pd=0;
	$obc=trim(strip_tags(cut_str($page,'Rank in OBC category : ','<br>')));
	$sc=trim(strip_tags(cut_str($page,'Rank in SC category : ','<br>')));
	$st=trim(strip_tags(cut_str($page,'Rank in ST category : ','<br>')));
	$pd=trim(strip_tags(cut_str($page,'Rank in PD category : ','<br>')));
	//if(strlen($course)<3)
	//	$course='Not Allotted';
	//if($course=='')
	//	$course=strip_tags(cut_str($page,'<font color="#ff0000"><b>','</b></font>'));
	//echo '<tr><td>'.$row[0].'</td><td>'.$row[1]."</td><td>$gen </td><td>$obc </td><td>$sc </td><td>$st </td><td>$pd</td></tr>";
	$rank=-1;
	if($obc)
	{
		$rank=$obc;
		$cat='OBC';
	}
	elseif($sc)
	{
		$rank=$sc;
		$cat='SC';
	}
	elseif($st)
	{
		$rank=$st;
		$cat='ST';
	}
	elseif($pd)
	{
		$rank=$pd;
		$cat='PD';
	}
	else
		$cat='GE';
	$qu="UPDATE results SET catrank='$rank', cat= '$cat' where reg='$ff'";
	echo $qu."<br>";
	flush();
	//$qu="UPDATE results SET course='$course' where reg='$ff'";
	if($qu)
		mysqli_query($db,$qu);
}
function cut_str($str, $left, $right) { $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
 } 
 ?>