<?php
include 'config.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['delete_ids_books'])) {
    $delete_ids_books = explode(',', $_POST['delete_ids_books']);
    foreach ($delete_ids_books as $id) {
        $id = intval($id);
        $sql = "DELETE FROM books WHERE id=$id";
        $conn->query($sql);
    }

    header("Location: Admin1.php");
    exit();
}
?>







<?php

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='styled-table' id='booksTable'><thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>Description</th><th>PDF</th><th>Image</th><th>Actions</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
$description = $row["description"];
        $short_description = strlen($description) > 8 ? substr($description, 0, 8) . '...' : $description;
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td class='book-title'>".$row["title"]."</td>";
        echo "<td class='book-author'>".$row["author"]."</td>";
        echo "<td class='book-year'>".$row["year"]."</td>";
        echo "<td class='book-description' data-full-description='".htmlspecialchars($row["description"])."'>
            <span class='short-description'>".htmlspecialchars($short_description)."</span>
            <a href='#' class='more'>more</a>
        </td>";
        echo "<td><a href='".htmlspecialchars($row["pdf_path"])."' target='_blank' class='view-pdf-link'>View PDF</a></td>";
        echo "<td><img src='".htmlspecialchars($row["image_path"])."' alt='Book Image' class='book-image'></td>";
        echo "<td><button type='button' class='delete-book-btn' data-id='".$row["id"]."'>Delete</button><button type='button' class='edit-book-btn' data-id='".$row["id"]."'>Edit</button></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No books found</p>";
}
?>
<input type="hidden" id="delete-ids-books" name="delete_ids_books" value="">
