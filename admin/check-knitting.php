<?php
if ((!isset($_SESSION['isLoggedIn'])) && ((!$_SESSION['admin-role'] === 2) || (!$_SESSION['admin-role'] === 0))) {
    header('Location:logout');
}
