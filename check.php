<?php
require_once "functions.php"; 
header("Content-Type: application/json");
if(!isset($_POST["license_key"]))
{
	send_response("404","nolicense");
}

$license_key = $_POST["license_key"];

if(!isset($_POST["domain_name"]))
{
	send_response("404","nodomain");
}

$domain_name = $_POST["domain_name"];
$sql = "SELECT * FROM `licenses` WHERE `license_key`='$license_key' AND `domain_name`='$domain_name' AND `status`='VALID';";
$result = mysqli_query($conn, $sql);
if(!$result)
{
	send_response("500","DBError");
}
$count = mysqli_num_rows($result);
if($count == 1)
{
	send_response("200","Authorised");
}
else
{
	send_response("403","Unauthorised");
}
?>
