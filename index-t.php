<?php
/** Initial form for birthdays
 * @author : Abhay Rana
 * This is the scheduling script to schedule it on multiple computers
 * Each node requests for a job, and we respond with a regno, formno to check
 *
 */
error_reporting(E_ALL);
ini_set("display_errors",1);
$db = new mysqli("localhost","root","","iitjee");
$re=$db->query("SELECT regno, form_no  FROM selected where date = ''");
$response = $re->fetch_row();
echo json_encode($response);
?>


