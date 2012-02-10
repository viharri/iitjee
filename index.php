<?php
/** Initial form for birthdays
 * @author : Abhay Rana
 * This is the scheduling script to schedule it on multiple computers
 * Each node requests for a job, and we respond with a regno, formno to check
 *
 */
error_reporting(E_ALL);
ini_set("display_errors",1);
$db = new mysqli("localhost","root","nemoabhay","iitjee");
$re=$db->query("SELECT regno, form_no  FROM selected where date is null");
$re or die("complete");
$response = $re->fetch_row();
echo json_encode($response);
//Now since this is a scheduled task,mark it as such
$regno = $response[0];
$db->query("UPDATE selected set date ='*' WHERE regno = '$regno'");


