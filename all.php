<?php
include "Snoopy.class.php";
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
 $snoopy->rawheaders["Pragma"] = "no-cache";
 $link='http://jee.iitm.ac.in/post-exam/Counseling/INDIVIDUAL_PDF/';
 $snoopy->fetchlinks($link);
 foreach($snoopy->results as $link)
{
	$link=substr($link,-11,7);
	echo $link."<br>";
}
 ?>