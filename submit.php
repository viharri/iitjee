<?php
/** Part of the scheduling script
 * This one takes responses from various nodes 
 */
$regno = $_GET['reg'];
$date = $_GET['date'];
if($regno&&$date):
  $db = new mysqli("localhost","root","nemoabhay","iitjee");
  $db->query("UPDATE selected set date='$date' WHERE regno='$regno'");
  echo ("UPDATE selected set date='$date' WHERE regno='$regno'");
else:
  echo "Something went wrong";
endif;
