<h2>Additional Information: Kindly read the Disclaimer, and additional information, including Center wise count, and information on missing ranks <b><a href='disclaimer.html'>over here</a>, before proceeding to sue me, or using this data. If you do not agree to any of these conditions, kindly quit now.</h2>
<table><tr><th>Registration Number</th><th>Name</th><th>Rank</th><th>Cat</th>
<th>Chemistry</th>
<th>Physics</th>
<th>Maths</th>
<th>Total</th>
</tr><?php
$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
$q="SELECT * from results order by cat, rank ASC ";
$q=mysqli_query($db,$q);
while($row=mysqli_fetch_row($q)){
	$reg=$row[0];
	$name=$row[1];
	$rank=$row[2];
	$cat=$row[3];
	$chem=$row[4];
	$phy=$row[5];
	$mat=$row[6];
	$tot=$row[7];	
	echo '<tr><td>'.$reg.'</td><td>'.$name.'</td><td>'.$rank.'</td><td>'.$cat.'</td>
	<td>'.$chem.'</td>
	<td>'.$phy.'</td>
	<td>'.$mat.'</td>
	<td>'.$tot.'</td>
	</tr>';
	
}
?>