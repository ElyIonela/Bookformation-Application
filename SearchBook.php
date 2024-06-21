<?php
include 'config.php';
session_start();
if (!isset($_SESSION['admin_username']) && !isset($_SESSION['user_username'])) {
    header('Location: LogIn.php');
    exit();
}
?>



<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Search Your Book</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <link href="styleSearch2.css" rel="stylesheet" />



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var pageInfo = document.querySelector('.container');
            var menuButton = document.querySelector('#check');

            // Afișează caseta de informații la încărcarea paginii

            setTimeout(function () {
                pageInfo.classList.add('show-info');
            }, 100);

            // Ascunde caseta de informații când se apasă butonul de meniu
            menuButton.addEventListener('click', function () {
                pageInfo.classList.toggle('show-info');
            });
        });
    </script>

</head>
<body>
  <div id="navigation">
      <nav>
       <input type="checkbox" id="check" />
       <label for="check" class="checkbtn">
           <i class="bx bx-menu"></i>

       </label>
       <img src="css/logo.png" class="logos" />
       <label class="logo">BookFormation</label>
       <ul>
           <li><a href="HomePage.php" >home</a></li>
           <li><a href="AboutUs.php" >about </a></li>
           <li><a href="SearchBook.php" class="active">Books</a></li>
           <li><a href="Contact.php" >contact</a></li>
       <li><a href="check_login.php?redirect=SearchBook.php"><i class='bx bxs-user-account'></i></a></li>

       </ul>
   </nav>
      </div>
<div class="container">
<div class="search-box">
                            <input type="text" id="searchBook" placeholder="Search for a book...">
                            <button type="button" class="btn-search" id="searchButton"><i class='bx bx-search-alt-2'></i></button>
                        </div>
<section class="search-listing">
<div class="product-container">
 <?php
                include 'config.php';
                 $sql = "SELECT id, title, author, image_path, pdf_path FROM books";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        echo "<div class='product' data-id='".$row["id"]."'>";
                        echo "<img src='".htmlspecialchars($row["image_path"])."' alt='Book Image' class='book-image'>";
                        echo "<div class='product-info'>";
                        echo "<h3>".$row["title"]."</h3>";
                        echo "<p>".$row["author"]."</p>";
echo "<button class='add-to-favorites'><i class='bx bxs-book-heart'></i></button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No books found</p>";
                }
                ?>
</div>
</section>

</div>


<div id="book-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-left">
            <img id="modal-image" src="" alt="Book Image">
        </div>
        <div class="modal-right">
            <h2 id="modal-title"></h2>
            <p id="modal-author"></p>
            <p id="modal-year"></p>
            <p id="modal-description"></p>
            <a id="modal-view-pdf" href="#" target="_blank" class="btn">View PDF</a>
            <a id="modal-download-pdf" href="#" download class="btn">Download PDF</a>
            <button id="modal-add-to-favorites" class="btn"><i class='bx bxs-book-heart'></i> Add to Favorites</button>
        </div>
    </div>
</div>

<script src="scriptBooks1.js"></script>
</body>
</html>