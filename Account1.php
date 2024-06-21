<?php
session_start();
include 'config.php';

// Presupunând că ID-ul utilizatorului este stocat în sesiune
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$username = "";
$email = "";

if ($user_id) {
    // Fetch user data
    $sql = "SELECT username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
    } else {
        // Dacă utilizatorul nu este găsit, setează valori implicite
        $username = "";
        $email = "";
    }

    $stmt->close();
}


// Fetch favorite books
$favorites = [];
if ($user_id) {
    $sql = "SELECT books.id, books.title, books.author, books.image_path FROM books 
            JOIN favorites ON books.id = favorites.book_id WHERE favorites.user_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $favorites[] = $row;
    }

    $stmt->close();
}




$conn->close();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>User Profile</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="styleUser3.css" rel="stylesheet" />
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cont = document.querySelector('.container');
            var menuButton = document.querySelector('#check');

            setTimeout(function () {
                cont.classList.add('show-info'); 
            }, 100);

            menuButton.addEventListener('click', function () {
                cont.classList.toggle('show-info');
            });


           document.getElementById('account-link').addEventListener('click', function() {
                document.getElementById('account-settings').style.display = 'block';
                document.getElementById('settings').style.display = 'none';
                document.getElementById('favorites-section').style.display = 'none';
            });

            document.getElementById('settings-link').addEventListener('click', function() {
                document.getElementById('account-settings').style.display = 'none';
                document.getElementById('settings').style.display = 'block';
                document.getElementById('favorites-section').style.display = 'none';
            });

            document.getElementById('books-link').addEventListener('click', function() {
                document.getElementById('account-settings').style.display = 'none';
                document.getElementById('settings').style.display = 'none';
                document.getElementById('favorites-section').style.display = 'block';
            });

           document.getElementById('logout-link').addEventListener('click', function() {
                document.getElementById('logout-modal').style.display = 'block';
            });

            document.getElementById('logout-cancel').addEventListener('click', function() {
                document.getElementById('logout-modal').style.display = 'none';
            });

            document.getElementById('logout-confirm').addEventListener('click', function() {
                window.location.href = 'logout.php';
            });


// Modal functionality
    const products = document.querySelectorAll('.product');
    const modal = document.getElementById('book-modal');
    const modalImage = document.getElementById('modal-image');
    const modalTitle = document.getElementById('modal-title');
    const modalAuthor = document.getElementById('modal-author');
    const modalYear = document.getElementById('modal-year');
    const modalDescription = document.getElementById('modal-description');
    const modalViewPdf = document.getElementById('modal-view-pdf');
    const modalDownloadPdf = document.getElementById('modal-download-pdf');
    
    const span = document.getElementsByClassName('close')[0];

    products.forEach(function (product) {
        product.addEventListener('click', function () {
            const bookId = this.getAttribute('data-id');
            fetch(`get_book_details.php?id=${bookId}`)
                .then(response => response.json())
                .then(data => {
                    modalImage.src = data.image_path;
                    modalTitle.textContent = data.title;
                    modalAuthor.textContent = `Author: ${data.author}`;
                    modalYear.textContent = `Year: ${data.year}`;
                    modalDescription.textContent = `Description: ${data.description}`;
                    modalViewPdf.href = data.pdf_path;
                    modalDownloadPdf.href = data.pdf_path;
                   
                    modal.style.display = 'block';
                });
        });

    });

    span.onclick = function () {
        modal.style.display = 'none';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };


   const searchButton = document.getElementById('searchButton');
    const searchBookInput = document.getElementById('searchBook');

    searchButton.addEventListener('click', function () {
        const searchTerm = searchBookInput.value.toLowerCase();
        const products = document.querySelectorAll('.product');

        products.forEach(function (product) {
            const title = product.querySelector('.product-info h3').innerText.toLowerCase();
            const author = product.querySelector('.product-info p').innerText.toLowerCase();

            if (title.includes(searchTerm) || author.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
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
                <li><a href="HomePage.php">home</a></li>
                <li><a href="AboutUs.php">about </a></li>
                <li><a href="SearchBook.php">books</a></li>
                <li><a href="Contact.php">contact</a></li>
                <li><a href="LogIn.php" class="active"><i class='bx bxs-user-account'></i></a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
<span class="big-circle"></span>
        <span class="circle one"></span>
        <span class="circle two"></span>
        <div class="profile">
            <div class="profile-header">
                <h1>Reader Profile</h1>
            </div>
            <div class="menu">
                <a href="#" id="account-link" class="menu-link">
                    <i class='bx bxs-user-circle'></i>
                    Account
                </a>
                <a href="#" id="settings-link" class="menu-link">
                    <i class='bx bxs-cog'></i>
                    Edit
                </a>
               <a href="#" id="books-link" class="menu-link">
                    <i class='bx bxs-book-heart'></i>
                    Favorites
                </a>
                <a href="#" id="logout-link" class="menu-link">
                    <i class='bx bx-log-out'></i>
                    Log Out
                </a>
                
            </div>
        </div>

        <div id="account-settings" class="account">
            <form method="POST" action="update_account.php">
                <div class="account-header">
                    <h1 class="account-title">Account Info</h1>
                    
                </div>

                <div class="account-edit">
                    <div class="input-container">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" />
                    </div>
                    <div class="input-container">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                    </div>
                    
                </div>
            </form>
        </div>

        <div id="settings" class="account" style="display: none;">
            <form method="POST" action="update_settings.php">
                <div class="account-header">
                    <h1 class="account-title">Change Info</h1>
                    <div class="btn-container">
                        <button type="button" class="btn-cancel">Cancel</button>
                        <button type="submit" class="btn-save">Save</button>
                    </div>
                </div>

                <div class="account-edit">
                    <div class="input-container">
                        <label>Username</label>
                        <input type="text" name="new_username" value="<?php echo htmlspecialchars($username); ?>" />
                    </div>
                    <div class="input-container">
                        <label>Email</label>
                        <input type="text" name="new_email" value="<?php echo htmlspecialchars($email); ?>" />
                    </div>
                    <div class="input-container">
                        <label>Current Password</label>
                        <input type="password" name="current_password" />
                    </div>
                    <div class="input-container">
                        <label>New Password</label>
                        <input type="password" name="new_password" />
                    </div>
                    <div class="input-container">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_new_password" />
                    </div>
                </div>
            </form>
        </div>
    



 <div id="favorites-section" class="account" style="display: none;">
            <div class="account-header">
                <h1 class="account-title"> My Favorites Books</h1>
                         <div class="btn-container">
                        <div class="search-box">
                            <input type="text" id="searchBook" placeholder="Search for a book...">
                            <button type="button" class="btn-search" id="searchButton"><i class='bx bx-search-alt-2'></i></button>
                        </div>
                        
                    </div>
            </div>
<div class="account-edit">
            <div class="product-container">
                <?php
 
                if (!empty($favorites)) {
                    foreach ($favorites as $book) {
                        echo "<div class='product' data-id='".$book["id"]."'>";
                        echo "<img src='".htmlspecialchars($book["image_path"])."' alt='Book Image' class='book-image'>";
                        echo "<div class='product-info'>";
                        echo "<h3>".$book["title"]."</h3>";
                        echo "<p>".$book["author"]."</p>";
                       
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No favorite books found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
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
            
        </div>
    </div>
</div>

<div id="logout-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Confirm Log Out</div>
            <div class="modal-body">Are you sure you want to log out?</div>
            <div class="modal-footer">
                <button id="logout-cancel" class="btn-cancel">Cancel</button>
                <button id="logout-confirm">Log Out</button>
            </div>
        </div>
    </div>



</body>
</html>