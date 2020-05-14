<?php
	session_start();
	if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==TRUE) {
	}
	else{
	echo '<script>window.location.href = "index"</script>';
	}
?>
