<?php
require_once ('./config.php');
require_once ('./Models/User.php');
if (!empty($_GET["emailid"])) {
    $isEmail = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$_GET["emailid"]);
    if (!$isEmail) {
		echo json_encode(['isEmailValid' => false, 'message' => 'Email is invalid', 'status' => false]);
		exit;
    } else {
		$emailcheck = new User();
		$result = $emailcheck -> getEmail($_GET["emailid"]);
        if ($result) {
            echo json_encode(['isEmailUnique' => false, 'message' => 'Email already exisits', 'status' => false]);
        } else {
            echo json_encode(['isEmailUnique' => true, 'message' => 'Email available for registration', 'status' => true]);
        }
		exit;
    }
}
?>