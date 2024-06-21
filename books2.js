document.addEventListener('DOMContentLoaded', function () {
    let deleteBookIds = [];
    const searchButton = document.getElementById('searchButton');
    const searchBookInput = document.getElementById('searchBook');
    const booksTable = document.getElementById('booksTable');

    if (searchButton) {
        searchButton.addEventListener('click', function() {
            console.log("Search button clicked");
            const searchTerm = searchBookInput.value.toLowerCase();
            console.log("Search term: ", searchTerm);
            let found = false;

            if (booksTable) {
                const rows = booksTable.getElementsByTagName('tr');
                for (let i = 1; i < rows.length; i++) { // Skip header row
                    const title = rows[i].getElementsByTagName('td')[1].innerText.toLowerCase();
                    const author = rows[i].getElementsByTagName('td')[2].innerText.toLowerCase();

                    if (title.includes(searchTerm) || author.includes(searchTerm)) {
                        rows[i].style.display = 'table-row'; // Highlight row
                        found = true;
                    } else {
                        rows[i].style.display = 'none'; // Reset row
                    }
                }

                if (!found) {
                    alert('No books found');
                }
            } else {
                console.log("Books table not found");
            }
        });
    } else {
        console.log("Search button not found");
    }

    const bookForm = document.getElementById('bookForm');
    if (bookForm) {
        bookForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_book.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    window.location.href = 'Admin1.php'; // Redirecționează la Admin1.php după adăugare
                }
            }
            xhr.send(formData);
        });
    } else {
        console.log("Book form not found");
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-book-btn')) {
            const bookId = event.target.getAttribute('data-id');
            deleteBookIds.push(bookId);
            event.target.closest('tr').remove(); // Șterge cartea din interfață
            const deleteIdsInput = document.getElementById('delete-ids-books');
            if (deleteIdsInput) {
                deleteIdsInput.value = deleteBookIds.join(',');
            } else {
                console.log("Delete IDs input not found");
            }
        }

if (event.target.classList.contains('edit-book-btn')) {
            const bookId = event.target.getAttribute('data-id');
            // Populate the modal with book data
            document.getElementById('editBookId').value = bookId;
            document.getElementById('editBookTitle').value = event.target.closest('tr').querySelector('.book-title').innerText;
            document.getElementById('editBookAuthor').value = event.target.closest('tr').querySelector('.book-author').innerText;
            document.getElementById('editBookYear').value = event.target.closest('tr').querySelector('.book-year').innerText;
            document.getElementById('editBookDescription').value = event.target.closest('tr').querySelector('.book-description').innerText;

            document.getElementById('edit-book-modal').style.display = 'block';
        }
});
// Event listener for description click
document.querySelectorAll('.book-description .more').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            const fullDescription = this.parentElement.getAttribute('data-full-description');
          modalContent.textContent = fullDescription;
                    modal.style.display = 'block';
        });
    });

document.getElementById('editBookSaveBtn').addEventListener('click', function() {
        const editBookForm = document.getElementById('editBookForm');
        const formData = new FormData(editBookForm);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'edit_book.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                alert('Book updated successfully');
                window.location.reload();
            }
        }
        xhr.send(formData);
    });

    const saveBooksButton = document.querySelector('.btn-save-books');
    if (saveBooksButton) {
        saveBooksButton.addEventListener('click', function(event) {
            event.preventDefault();
            
            const deleteBIds = document.getElementById('delete-ids-books').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_books.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert('Changes saved successfully');
                    window.location.reload();
                }
            }
            xhr.send('delete_ids_books=' + encodeURIComponent(deleteBIds)); // Corrected line
        });
    } else {
        console.log("Save books button not found");
    }

     // Modal Elements
    const modal = document.getElementById('descriptionModal');
    const modalContent = document.getElementById('fullDescription');
    const span = document.getElementsByClassName('close')[0];

    // Close the modal when the user clicks on <span> (x)
    if (span) {
        span.onclick = function() {
            modal.style.display = 'none';
        }
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});