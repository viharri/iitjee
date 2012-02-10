<?php
$id=base64_decode($_GET['id']);
if($id)
{
	$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
	mysqli_query($db,"update results set gender=gender-1 where reg='$id'");
	echo "Report acknowledged .  Only multiple reports will trigger a reaction.";
}