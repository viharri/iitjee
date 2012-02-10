<?php
/** Initial form to get selected candidates
 * @author : Abhay Rana
 */
error_reporting(E_ALL);
set_time_limit(1000000);
include "Snoopy.class.php";
//initial 1107397
$i=1;
$j = 10;
$l=7;
$k=398;
$snoopy=new snoopy;
$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$snoopy->rawheaders["Pragma"] = "no-cache";
$centers_per_zone = array(19,16,14, 12,26, 22,22);//Starts from 1
$db = new mysqli("localhost","root","nemoabhay","iitjee");
$invalid = 0;
$form = array();
for(;$i<8;$i++){//zones
	//echo "Zone $i\n";
	for(;$j<=$centers_per_zone[$i-1];$j++){//centers per zone
		//echo "Center $j\n";
		for(;$l<10;$l++){//l is schools per center
			//echo "School $l\n";
			for(;$k<1000;$k++){//k is students per school
				$reg_no = strval($i).str_pad($j,2,"0",STR_PAD_LEFT).strval($l).str_pad($k,3,"0",STR_PAD_LEFT);
				$form['regno'] = $reg_no;
				$form['submit'] = "Submit";
				$snoopy->submit("http://192.168.216.1/resultstatus.php",$form);
				if(strpos($snoopy->results,'is invalid')!==false){
					$invalid++;
					if($invalid == 10)
					{
						$invalid = 0;
						$k = 1000;
					}
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
					$invalid = 0;
				}
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
