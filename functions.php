<?php
	session_start();

$db["host"] = "localhost";
// $db["user"] = "ninedulf_auth";
$db["user"] = "root";
$db["pass"] = "jordan88";
$db["name"] = "ninedulf_auth";

$conn = mysqli_connect($db["host"],$db["user"],$db["pass"],$db["name"]);

if(!$conn)
{
	die("Error connecting database");
}

function send_response($code,$message) {
	$response["status_code"] = $code;
	$response["status_message"] = $message;

	$json = json_encode($response);
	echo $json;
	die();
}

	function login() {
		global $conn; 

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$exist = mysqli_query($conn, "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'");
		if(mysqli_num_rows($exist) == 1) {
			$store = mysqli_fetch_assoc($exist);

			$_SESSION['user'] = $store;
			header("location: admin.php");
			
		}
	}
	
	function isLoggedIn() {
		if(isset($_SESSION['user'])) {
			return true;
		} else {
			return false;
		}
	}

	if(isset($_SESSION['user'])) {
		$userId = $_SESSION['user']['id'];
		$getUser = mysqli_prepare($conn, "SELECT username, seller_level FROM users WHERE id = ?");
		mysqli_stmt_bind_param($getUser, "i", $userId);
		mysqli_stmt_execute($getUser);
		mysqli_stmt_bind_result($getUser, $username, $level);
		mysqli_stmt_fetch($getUser);

		mysqli_stmt_close($getUser);
	}
	
	if(isset($_SESSION['user'])) {
		$getWallet = mysqli_prepare($conn, "SELECT amount FROM wallets WHERE wallet_for = ?");
		mysqli_stmt_bind_param($getWallet, "s", $username);
		mysqli_stmt_execute($getWallet);
		mysqli_stmt_bind_result($getWallet, $money);
		mysqli_stmt_fetch($getWallet);

		mysqli_stmt_close($getWallet);
	}

	function genLicenseKey($length = 4) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

?>
