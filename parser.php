<?php
$db = new mysqli("localhost","root","","iitjee");
$result = $db->query("SELECT * FROM results_2011_raw order by regno");
while($row = $result->fetch_assoc()){
	$regno = $row['regno'];
	$raw_string = $row['data'];
	//Name is not present in prep course and maybe other cases
	if(strpos($row['data'],'Name')!==false){
		$name =  cut_str($row['data'],"Name  :  ","Registration");
		$form_no =  cut_str($row['data'],"Form Number : ","Congratula");
		if(strpos($row['data'],'category')!==false){
			//different stripping
			if(strpos($row['data'],'All India')!==false){	
				//If subject has an all india rank
				$air =  cut_str($row['data'],"All India Rank  :  ","Your");
			}
			else{
				$air = 0 ;
			}
			$catrank = cut_str($row['data'],"category :  ","Click");
			$cat = cut_str($row['data'],'Your Rank in ',' category');
		}
		else{
			//No category given, assume GE
			$air =  cut_str($row['data'],"All India Rank  :  ","Click");
			$catrank = 0;
			$cat = 'GE';
		}
		$db->query("INSERT INTO selected VALUES ('$regno','$name','$air','$catrank','$cat','$form_no')");
	}
}
function cut_str($str, $left, $right) {
 $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
}
