<?php
include 'config.php';
session_start();

$redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : 'SearchBook.php';

// Check if the user is logged in as either admin or user
if (isset($_SESSION['admin_username'])) {
    $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'Admin1.php';
    unset($_SESSION['redirect_url']);
    header('Location: ' . $redirect_url);
    exit();
} else if (isset($_SESSION['user_username'])) {
    $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'Account1.php';
    unset($_SESSION['redirect_url']);
    header('Location: ' . $redirect_url);
    exit();
} else {
    // Store the redirect URL in the session
    $_SESSION['redirect_url'] = $redirect_url;
    header('Location: LogIn.php');
    exit();
}
?>
