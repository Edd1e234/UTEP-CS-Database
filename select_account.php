<?php
session_start();

if (isset($_GET['account_name'])) {
    $_SESSION['account_name'] = $_GET['account_name'];
    header("Location: studentsCode/menu.php");
} else {
    header("Location: view_account.php");
}
?>
