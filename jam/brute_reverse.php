<?php
/** Initial form to get selected candidates
 * @author : Abhay Rana
 */
error_reporting(E_ALL);
set_time_limit(0);
include "Snoopy.class.php";
$snoopy = new snoopy;
for($i=7999999;$i>=1000001;$i--){
	echo $i;
	if(file_exists("./html/$i.html"))
		echo "~\r";			
	else
	{
		$result = submit($i);
		if($result)
		{
			file_put_contents ("./html/$i.html",$result);
			echo "#\r";
		}
		else
			echo "*\r";
	}
}
function submit($reg){
  global $snoopy;
  $form['reg_no'] = $reg;
  $form['submit_but'] = "View Status";
  $snoopy->submit("http://gate.iitr.ernet.in/jam2011/scorecard.php",$form);
  $result = cut_str($snoopy->results,"</center></h1>","<a");
  if(strpos($result,"Invalid")!==false)
    return false;
  else if(strpos($result,"invalid")!==false)
    return false;
  else
    return $result;
}
function cut_str($str, $left, $right) {
 $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
}
