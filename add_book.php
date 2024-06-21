<?php
include 'config.php';

$title = $_POST['title'];
$author = $_POST['author'];
$year = $_POST['year'];
$description = $_POST['description'];
$image_path = null;

if (isset($_FILES['book_image']) && $_FILES['book_image']['error'] == 0) {
    $image_tmp = $_FILES['book_image']['tmp_name'];
    $image_name = basename($_FILES['book_image']['name']);
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_new_name = uniqid() . '.' . $image_ext;
    $image_upload_dir = 'uploads/images/';
    
    if (!is_dir($image_upload_dir)) {
        mkdir($image_upload_dir, 0777, true);
    }

    $image_path = $image_upload_dir . $image_new_name;

    if (!move_uploaded_file($image_tmp, $image_path)) {
        echo "Failed to upload image.";
        exit();
    }
}



// Verificăm dacă fișierul a fost încărcat
if (isset($_FILES['book_pdf']) && $_FILES['book_pdf']['error'] == 0) {
    $file_tmp = $_FILES['book_pdf']['tmp_name'];
    $file_name = basename($_FILES['book_pdf']['name']);
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $upload_dir = 'uploads/pdfs/';
    
    // Creăm directorul de încărcare dacă nu există
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $upload_path = $upload_dir . $file_new_name;

    // Mutăm fișierul în directorul de încărcare
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Utilizare instrucțiuni pregătite pentru a preveni SQL Injection
        $stmt = $conn->prepare("INSERT INTO books (title, author, year,pdf_path, image_path, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $title, $author, $year, $upload_path, $image_path, $description);

        if ($stmt->execute()) {
header("Location: Admin1.php");
            exit();
            // Afișăm toate cărțile după inserare cu succes
            $result = $conn->query("SELECT * FROM books");
            if ($result->num_rows > 0) {
                echo "<table class='styled-table'>";
                echo "<thead><tr><th>Title</th><th>Author</th><th>Year</th><th>PDF</th><th>Image</th><th>Description</th><th>Actions</th></tr></thead>";
                echo "<tbody id='bookList'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["year"]) . "</td>";
echo "<td>" . htmlspecialchars($row["description"]) . "</td>"; 
                    echo "<td><a href='" . htmlspecialchars($row["pdf_path"]) . "' target='_blank' class='view-pdf-link'>View PDF</a></td>";
 echo "<td><img src='".htmlspecialchars($row["image_path"])."' alt='Book Image' ></td>";
                    echo "<td><button class='action-btn delete-btn' data-id='" . $row["id"] . "'>Delete</button></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No books found";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "No file uploaded or there was an upload error.";
}

$conn->close();
?>