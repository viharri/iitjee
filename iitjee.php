<?php
header("Location: http://piratecoders.co.cc/iit-jee-results/");?>
List compiled by Abhay Rana- B.Tech IIT-R(P&I)<br>
<a href="http://piratecoders.co.cc">Here's</a> my home page and meet me on facebook <a href="http://www.facebook.com/capt.n3m0/">here</a><br>
You can also mail me @ capt dot n3m0 at gmail.com<br>
Additional Information: Kindly read the Disclaimer, and additional information, including Center wise count, and information on missing ranks <b><a href='disclaimer.html'>over here</a>, before proceeding to sue me, or using this data. If you do not agree to any of these conditions, kindly quit now.
<table><tr>
<th>Registration Number</th>
<th>Name</th>
<th>Rank</th>
<th>Cat</th>
<th>Chemistry</th>
<th>Physics</th>
<th>Maths</th>
<th>Total</th>
<th>Course Opted</th>
<th>GE Rank</th>
</tr>-
<?php
$db=mysqli_connect('localhost','capuser','','captnemo_db');
$q="SELECT * from results order by cat, catrank ASC ";
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
	$course=$row[8];
	$catrank=$row[9];
	if($rank=='0')
		$rank='';
	echo '<tr><td>'.$reg.'</td><td>'.$name.'</td><td>'.$catrank.'</td><td>'.$cat.'</td>
	<td>'.$chem.'</td>
	<td>'.$phy.'</td>
	<td>'.$mat.'</td>
	<td>'.$tot.'</td>
	<td>'.$course.'</td>
	<td>'.$rank.'</td>
	</tr>';
	
}
?>
