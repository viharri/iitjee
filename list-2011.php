<table><?php
$db = new mysqli("localhost","root","nemoabhay","iitjee");
$result = $db->query("SELECT * FROM selected order by cat, air, catrank ");
while($row = $result->fetch_assoc()){
?>
<tr>
	<td><?=ucwords(strtolower($row['name']))?></td>
	<td><?=$row['air']?></td>
	<td><?=$row['cat']?></td>
	<td><?=$row['catrank']?></td>
	<td>B***<?=substr($row['form_no'],-3)?></td>
</tr>
<?
}
?>
</table>
