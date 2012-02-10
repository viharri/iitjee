<?php
require_once 'facebook.php';
// Include our files
// App API Key and APP Secret
$appapikey = 'd0d4e83a3a9c5d817f7d9ce7eef48383';
$appsecret = 'c3bd384379e6f9980ce62d3c69e6b662';
// Callback URL and Canvas page URL
$appCallBackUrl = 'http://server6.freebeehosting.com/~captnemo/iitjee/';
$appCanvasUrl = 'http://apps.facebook.com/how-many-people-jee/';
$appTitle = "How many people with your name cleared JEE this year.";
$facebook = new Facebook($appapikey, $appsecret);
$user = $facebook->require_login();
