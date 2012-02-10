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
$q="SELECT * FROM results where reg like '2%' and reg>2076385";
$res=mysqli_query($db,$q);
while($row=mysqli_fetch_row($res))
{
	$form['Form_No']=$ff=$row[0];
	$name=str_replace(" ","",trim($row[1]));
	$name=substr($name,0,4);
	$form['Form_No'].=$name;
	$form['submit']='Submit';
	//echo $form['Form_No'];
	$snoopy->submit($link,$form);
	$page=$snoopy->results;
	if(strpos($page,'Registration Number is Invalid')===true) 	
		echo "Error Invalid $ff";
	else
	{	
		$marks=cut_str($page,'CC0000">','</font>');
		$chem=cut_str($marks,'C:',' ');
		$phy=cut_str($marks,'P:',' ');
		$mat=cut_str($marks,'M:',' ');
		$tot=cut_str($marks,'Total: ',' ');	
		echo "$ff--$chem--$phy--$mat--$tot<br>";
		flush();
		$qu="UPDATE results SET chem=$chem, phy=$phy, mat=$mat, tot=$tot where reg='$ff'";
		mysqli_query($db,$qu);
	}
}
function cut_str($str, $left, $right) { $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
 } 
 ?>