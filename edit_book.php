<?php
// edit_book.php

include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    $sql = "UPDATE books SET title = ?, author = ?, year = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisi', $title, $author, $year, $description, $book_id);

    if ($stmt->execute()) {
        echo 'Book updated successfully';
    } else {
        echo 'Error updating book: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method';
}
?>
