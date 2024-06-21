document.addEventListener('DOMContentLoaded', function () {
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
    const modalAddToFavorites = document.getElementById('modal-add-to-favorites');
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
                    modalAddToFavorites.setAttribute('data-id', bookId);
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

    modalAddToFavorites.addEventListener('click', function () {
        const bookId = this.getAttribute('data-id');
        fetch(`add_to_favorites.php?id=${bookId}`)
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert('Book added to favorites');
                } else if (data === 'exists') {
                    alert('Book is already in favorites');
                } else {
                    alert('Failed to add to favorites');
                }
                modal.style.display = 'none';
            });
    });

    // Add to favorites functionality for each book
    const favoritesButtons = document.querySelectorAll('.add-to-favorites');
    favoritesButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const bookId = this.closest('.product').getAttribute('data-id');
            fetch(`add_to_favorites.php?id=${bookId}`)
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Book added to favorites');
                    } else if (data === 'exists') {
                        alert('Book is already in favorites');
                    } else {
                        alert('Failed to add to favorites');
                    }
                });
        });
    });
    });





