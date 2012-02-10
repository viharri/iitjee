<?php
for($s=0;$s<10000;$s++){
$a=base_convert($s,10,3);
if(strlen($a))
  echo $a."\n";
}
