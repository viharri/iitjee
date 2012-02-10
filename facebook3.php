<?php
/* include the PHP Facebook Client Library to help
  with the API calls and make life easy */
require_once('facebook.php');

/* initialize the facebook API with your application API Key
  and Secret */
$facebook = new Facebook('','');

/* require the user to be logged into Facebook before
  using the application. If they are not logged in they
  will first be directed to a Facebook login page and then
  back to the application's page. require_login() returns
  the user's unique ID which we will store in fb_user */
$fb_user = $facebook->getUser();
if(!$fb_user)
	echo "hell";
/* now we will say:
  Hello USER_NAME! Welcome to my first application! */
?>

Hello <fb:name uid='<?php echo $fb_user; ?>' useyou='false' possessive='true' />! Welcome to my first application!

<?php

/* We'll also echo some information that will
  help us see what's going on with the Facebook API: */
echo "<pre>Debug:" . print_r($facebook,true) . "</pre>";

?>
<?php
$db=mysqli_connect('localhost','r','','');
$q="SELECT count(*) from results where name like '%abhay%'";
$result=mysqli_query($db,$q);
$row=mysqli_fetch_row($result);
$number=$row[0];
echo 'This year '.$number.' candidates with your name qualified for IIT-JEE. Congratz!';
?>
