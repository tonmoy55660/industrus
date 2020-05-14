<?php
session_start();
include_once("dbCon.php");
$conn = connect();
if (isset($_POST['register'])) {
	$query = "INSERT INTO user_login(name, email, password,company_name, phone)  VALUES (?, ?, ?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssss", $name, $email, $password, $company_name, $phone);

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, sha1($_POST['password']));
	$company_name =  mysqli_real_escape_string($conn, $_POST['company_name']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);

	if ($stmt->execute()) {
		$_SESSION['amsg'] = ['msg' => 'Registration succesful! Please Login to continue!', 'type' => 'success'];
		header('Location:login');
	} else {
		$_SESSION['amsg'] = ['msg' => 'Something went wrong! try again!', 'type' => 'danger'];
		header('Location:register');
	}
	$stmt->close();
	$conn->close();
}
