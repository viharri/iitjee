<?php
$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
$q="SELECT count(*) from results where course=''";
$q=mysqli_query($db,$q);
$row=mysqli_fetch_row($q);
echo $row[0];
?>