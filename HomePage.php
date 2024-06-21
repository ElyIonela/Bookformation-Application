<?php
include 'config.php';
session_start();


?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>BookFormation</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <link href="styleHome.css" rel="stylesheet" />



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var pageInfo = document.querySelector('.page-info');
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
           <li><a href="HomePage.php" class="active">home</a></li>
           <li><a href="AboutUs.php" >about </a></li>
           <li><a href="SearchBook.php" >Books</a></li>
           <li><a href="Contact.php" >contact</a></li>
        <li><a href="check_login.php"><i class='bx bxs-user-account'></i> </a></li>

       </ul>
   </nav>
      </div>
    <section id="banner">
    <div class="page-info">
       
            <h1>Your Book Just a Search Away </h1>
            <h2>Explore Endless Stories with BookFormation</h2>
        <p>Find your next literary adventure effortlessly with BookFormation. </p>
        <p>Dive into a world of endless stories, genres, and authors, all just a search away!</p>
        <div class="buttons">
        <button class="login-button" onclick="location.href='LogIn.php'">Log In</button>
         
    </div>
        </div>
    </section>

    

</body>
</html>
