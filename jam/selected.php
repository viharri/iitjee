<?php
/** Initial form to get selected candidates
 * @author : Abhay Rana
 */
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
//initial 1107397
// JAM    708????
$snoopy = new snoopy;
$s = time();
for($i=1000001;$i<=1001001;$i++)

for($i=2;$i<8;$i++)
{
	//Aiming for : 2110001
	//(2)(11) 0001
	//2111101
	$c1=0;//number of centers
	for($j=110;$j<1000;$j++){
	$c2=0;//number of people
		for($k=1;$k<1000;$k++){			
			$jj = str_pad($j,3,'0',STR_PAD_LEFT);
			$kk = str_pad($k,3,'0',STR_PAD_LEFT);
			$r = $i.$jj.$kk;
			if(file_exists("./html/$r.html")){
				$c2=0;
				echo "$r~\r";				
			}
			else{
				$result = submit($r);
				if($result)
				{
					$c2=0;
					file_put_contents ("./html/$r.html",$result);
					echo $r."\r";
				}
				else
				{
					echo $r."*\r";
					$c2++;
				}
				if($c2==20)
				  break;
		    }
		}
		if($k<=21)//very few people in the last institute
		{
			$c1++;
		}
		if($c1==2)
			break;	
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
