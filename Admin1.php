<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - BookFormation</title>
    <link rel="stylesheet" href="styleAdmin4.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="books2.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var cont = document.querySelector('.container');
    var menuButton = document.querySelector('#check');
    var deleteButtons = document.querySelectorAll('.delete-btn');
    var deleteIdsInput = document.getElementById('delete-ids');
    var deleteIds = [];

    var deleteBookButtons = document.querySelectorAll('.delete-book-btn');
 var deleteBookIdsInput = document.getElementById('delete-ids-books');
var deleteBookIds = [];

    setTimeout(function () {
        cont.classList.add('show-info'); 
    }, 100);

    menuButton.addEventListener('change', function () {
        if (menuButton.checked) {
            cont.style.display = 'none';
        } else {
            cont.style.display = 'flex';
        }
    });

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var bookId = button.getAttribute('data-id');
            deleteIds.push(bookId);
            button.closest('tr').remove();
            deleteIdsInput.value = deleteIds.join(',');
        });
    });


deleteBookButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var bookId = button.getAttribute('data-id');
                    deleteBookIds.push(bookId);
                    button.closest('tr').remove();
                    deleteBookIdsInput.value = deleteBookIds.join(',');
                });
            });

    document.getElementById('readers-link').addEventListener('click', function() {
        document.getElementById('admin-settings').style.display = 'block';
        document.getElementById('books-section').style.display = 'none';
        document.getElementById('add-book-section').style.display = 'none';
    });

    document.getElementById('books-link').addEventListener('click', function() {
        document.getElementById('admin-settings').style.display = 'none';
        document.getElementById('books-section').style.display = 'block';
        document.getElementById('add-book-section').style.display = 'none';
    });

    document.getElementById('add-book-link').addEventListener('click', function() {
        document.getElementById('admin-settings').style.display = 'none';
        document.getElementById('books-section').style.display = 'none';
        document.getElementById('add-book-section').style.display = 'block';
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

    document.querySelectorAll('.btn-cancel').forEach(function(cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.location.reload();
        });
    });

    document.querySelectorAll('.btn-cancel1').forEach(function(cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.location.reload();
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
                <h1>Admin Profile</h1>
            </div>
            <div class="menu">
                <a href="#" id="readers-link" class="menu-link">
                    <i class='bx bxs-book-reader'></i>
                    Readers
                </a>
                <a href="#" id="books-link" class="menu-link">
                    <i class='bx bxs-book'></i>
                    Books
                </a>
               <a href="#" id="add-book-link" class="menu-link">
                    <i class='bx bxs-book-add' ></i>
                    Add a Book
                </a>
                <a href="#" id="logout-link" class="menu-link">
                    <i class='bx bx-log-out'></i>
                    Log Out
                </a>
            </div>
        </div>

        <div id="admin-settings" class="admin">
            <form method="POST" action="Admin1.php">
                <div class="admin-header">
                    <h1 class="admin-title">Readers Info</h1>
                    <div class="btn-container">
                        <button type="button" class="btn-cancel">Cancel</button>
                        <button type="submit" class="btn-save">Save</button>
                    </div>
                </div>
                <div id="readers-table-container">
                    <?php include 'update_readers.php'; ?>
                </div>
            </form>
        </div>

         <div id="books-section" class="books" style="display: none;">
            <form method="POST" action="Admin1.php">
                <div class="books-header">
                    <h1 class="books-title">Books Info</h1>
                    <div class="btn-container">
                        <div class="search-box">
                            <input type="text" id="searchBook" placeholder="Search for a book...">
                            <button type="button" class="btn-search" id="searchButton"><i class='bx bx-search-alt-2'></i></button>
                        </div>
                        <button type="button" class="btn-cancel1">Cancel</button>
                        <button type="submit" class="btn-save-books">Save</button>
                    </div>
                </div>
                <div id="books-table-container">
                    <div id="bookList">
                        <?php include 'update_books.php'; ?>
                    </div>
                </div>
            </form>
        </div>

        

   <div id="add-book-section" class="books" style="display: none;">
            <form id="bookForm" method="POST" action="add_book.php" enctype="multipart/form-data">
                <div class="books-header">
                    <h1 class="books-title">Add a Book</h1>
                    <div class="btn-container">
                        <button type="button" class="btn-cancel1">Cancel</button>
                        <button type="submit" class="btn-save-books">Save</button>
                    </div>
                </div>
                <div class="input-container">
                    <input type="text" id="bookTitle" name="title" placeholder="Book Title" required>
                    <input type="text" id="bookAuthor" name="author" placeholder="Author" required>
                    <input type="number" id="bookYear" name="year" placeholder="Year" required>
<textarea id="descript" name="description" placeholder="Book Description" required></textarea>


                   <label class="file-upload">
                        <input type="file" id="bookPDF" name="book_pdf" accept="application/pdf" required>
                        <span>Upload PDF</span>
                    </label>
                    
                    <label class="file-upload">
                        <input type="file" id="bookImage" name="book_image" accept="image/*" required>
                        <span>Upload Image</span>
                    </label>

                </div>
            </form>
        </div>

<div id="edit-book-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Edit Book</div>
        <div class="modal-body">
            <form id="editBookForm">
                <input type="hidden" id="editBookId" name="book_id">
                <input type="text" id="editBookTitle" name="title" placeholder="Book Title" required>
                <input type="text" id="editBookAuthor" name="author" placeholder="Author" required>
                <input type="number" id="editBookYear" name="year" placeholder="Year" required>
                <textarea id="editBookDescription" name="description" placeholder="Book Description" required></textarea>
                <label class="file-upload">
                    Choose PDF
                    <input type="file" id="editBookPDF" name="book_pdf" accept="application/pdf">
                </label>
                <label class="file-upload">
                    Choose Image
                    <input type="file" id="editBookImage" name="book_image" accept="image/*">
                </label>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="document.getElementById('edit-book-modal').style.display='none'">Cancel</button>
           <button type="button" id="editBookSaveBtn">Save</button>
        </div>
    </div>
</div>

<div id="descriptionModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <p id="fullDescription"></p>
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
    </div>
</body>
</html>
