<?php
require('rb.php');
require('simple_html_dom.php');
R::setup("sqlite:jam.sqlite");
foreach(glob("html/*.html") as $f)
{
	$dom = file_get_html($f);
	$text = file_get_contents($f);
	$rows = $dom->find('#score_table',0)->find('tr');
	unset($dom);
	foreach($rows as $k=>$row){
		if($k<2)
			continue;
		echo $f."\r";
		$person = R::dispense('person');
		$person->name = trim(cut_str($text,'</b>','<br />'));
		$person->code = $row->find('td',0)->plaintext;
		$person->candidates = $row->find('td',1)->plaintext;
		$person->marks = $row->find('td',2)->plaintext;
		$person->gen = $row->find('td',3)->plaintext;
		$person->obc = $row->find('td',4)->plaintext;	
		$person->res = $row->find('td',5)->plaintext;
		$person->air = $row->find('td',6)->plaintext;
		$person->reg = substr(basename($f),0,7);
		R::store($person);
	}
}

function cut_str($str, $left, $right) {
 $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
 $leftLen = strlen ( stristr ( $str, $right ) );
 $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
 $str = substr ( $str, 0, $leftLen );
 return $str;
}
