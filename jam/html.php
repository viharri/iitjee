<table>
<tr>
  <th>Name</th>
  <th>Registration</th>
  <th>Paper Code</th>
  <th>AIR</th>
  <th>Marks</th>
  <th>#Candidates</th>
  <th>GEN</th>
  <th>OBC</th>
  <th>SC/ST/PD</th>
</tr>
<?php
// Display as HTML
require('rb.php');
R::setup("sqlite:jam.sqlite");
$rows = R::$adapter->get("select * from person  ORDER BY code, air"); 
$result =  R::$redbean->convertToBeans("person", $rows); 
foreach($result as $p)
{
	$name = ucwords($p->name);
	$str = <<<"EOD"
<tr><td>$name</td><td>{$p->reg}</td><td>{$p->code}</td><td>{$p->air}</td><td>{$p->marks}</td><td>{$p->candidates}</td><td>{$p->gen}</td><td>{$p->obc}</td><td>{$p->res}</td></tr>
EOD;
echo $str;
}
?>
</table>
