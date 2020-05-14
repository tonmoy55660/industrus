<?php
session_start();
include_once("dbCon.php");
$conn = connect();
if (isset($_POST["login"])) {

	$sql = "SELECT * FROM user_login where email =? AND password=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, sha1($_POST['password']));

	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	$conn->close();
	if ($result->num_rows > 0) {
		$_SESSION['isLoggedIn'] = TRUE;
		while ($row = $result->fetch_assoc()) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['company_name'] = $row['company_name'];
		}

		header('Location:index');
	} else {

		$_SESSION['amsg'] = ['msg' => 'Invalid Login!', 'type' => 'danger'];
		header('Location:login');
	}
}
