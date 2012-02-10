<?php
require_once 'appinclude.php'; 
$facebook = new Facebook('d0d4e83a3a9c5d817f7d9ce7eef48383','c3bd384379e6f9980ce62d3c69e6b662');
$fb_user = $facebook->require_login();
$fb_user = $facebook->user;
$about = $facebook->api_client->users_getInfo($fb_user,'first_name');
$name=$about[0];
$name=$name['first_name'];
$db=mysqli_connect('localhost','captnemo_user','password','captnemo_db');
$q="SELECT count(*) from results where name like '%$name%'";
//echo $q."<br>";
$result=mysqli_query($db,$q);
$row=mysqli_fetch_row($result);
$number=$row[0];
$post='This year '.$number.' candidates with your name qualified for IIT-JEE. Congratz!';
echo $post;

// include ('jsonwrapper/JSON/JSON.php');	
echo 'I am about to pop up a feed story box please wait...';
$thefact=$post;
$fimage = 'http://naukri.im/wp-content/uploads/2010/04/iit-jee.gif';
$attachment = array( 'name' => 'How many people with your name cleared JEE?', 'href' => $appCanvasUrl, 'caption' => '{*actor*} checked the JEE results.', 'description' => $thefact, 'properties' => array('Check Your Name' => array( 'text' => 'Click here to check your name results', 'href' => $appCanvasUrl)), 'media' => array(array('type' => 'image', 'src' => $fimage, 'href' => $appCanvasUrl))); 
$actions=array(array('text' => 'Check your results', 'href' => $appCanvasUrl) );
$attachment= json_encode($attachment);
$actions= json_encode($actions);
?>
<script>
Facebook.streamPublish('dream', null, null, null, 'What do you think?', callback);
</script>
