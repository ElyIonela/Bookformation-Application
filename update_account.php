<?php
session_start();
include 'config.php';

// Presupunând că ID-ul utilizatorului este stocat în sesiune
$user_id = $_SESSION['user_id'];

// Selectăm detaliile utilizatorului din baza de date
$sql = "SELECT username, email FROM users WHERE id=?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();


header('Location: Account1.php');
exit();
?>
