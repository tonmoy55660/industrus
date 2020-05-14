<?php
if ((!isset($_SESSION['isLoggedIn'])) && ((!$_SESSION['admin-role'] === 4) || (!$_SESSION['admin-role'] === 0))) {
    header('Location:logout');
}
