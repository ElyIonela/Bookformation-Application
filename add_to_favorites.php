<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $userId = $_SESSION['user_id'];
    $bookId = intval($_GET['id']);
    
    // Check if the favorite already exists
    $checkSql = "SELECT * FROM favorites WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ii", $userId, $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'exists';
    } else {
        // Insert the new favorite
        $sql = "INSERT INTO favorites (user_id, book_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $bookId);
        
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    $stmt->close();
} else {
    echo 'invalid';
}

$conn->close();
?>
