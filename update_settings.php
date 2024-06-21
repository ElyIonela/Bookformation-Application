<?php
session_start();
include 'config.php';

// Presupunând că ID-ul utilizatorului este stocat în sesiune
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $current_password = md5($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Verificăm dacă parolele noi se potrivesc
    if ($new_password !== $confirm_new_password) {
        die('New passwords do not match.');
    }

    // Verificăm parola actuală
    $sql = "SELECT password FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if ($current_password !== $hashed_password) {
        die('Current password is incorrect.');
    }

    // Update user data
    $new_password_hash = md5($new_password);

    $sql = "UPDATE users SET username=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("sssi", $new_username, $new_email, $new_password_hash, $user_id);

    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();
}

header('Location: Account1.php');
exit();
?>
