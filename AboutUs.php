<?php
include 'config.php';
session_start();


?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
     <title>About</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="styleAbout1.css" rel="stylesheet" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cont = document.querySelector('.about-info');
            var menuButton = document.querySelector('#check');

            setTimeout(function () {
                cont.classList.add('show-info');
            }, 100);
            menuButton.addEventListener('click', function () {
                cont.classList.toggle('show-info');
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
           <li><a href="AboutUs.php" class="active">about</a></li>
           <li><a href="SearchBook.php" >books</a></li>
           <li><a href="Contact.php" >contact</a></li>
<li><a href="check_login.php"><i class='bx bxs-user-account'></i> </a></li>
       </ul>
        </nav>
    </div>


    <div class="container">
        <div class="bg-color"></div>

        <div class="about-info">


             <div class="text-about">
            <h1>About us</h1>
                <p>Here at BookFormation, we believe that books are 
                    gateways 
                    to knowledge and imagination.
                    Whether you're a reader, a student,
                    or someone looking to explore new ideas, 
                    our mission is to provide you with a comprehensive 
                    resource for discovering, learning about, 
                    and enjoying books.
               </p>
                     <p3>Books should be accessible
                     to everyone, and we 
                     make this a reality by offering free 
                     PDF downloads and a wealth of information 
                     about thousands of books across various
                     genres and categories.</p3>
                <p1 class="continua">
                        Join our growing community of book lovers and start your
                    journey of discovery with BookFormation.
                    </p1>
                    <input type="submit" value="Join" onclick="location.href='LogIn.php'" class="btn" "/>
                   <p2 class="continua">
                       If you have any questions or need 
                       any information, feel free to contact us.
                   </p2>
                    
                    <input type="submit" value="Contact Us" onclick="location.href='Contact.php'" class="btn" "/>

            </div>

            <div class="image-about">
                <img src="img/aboutus.jpeg" alt="" /> 
            </div>

            <span class="big-circle"></span>
            <span class="circle one"></span>
            <span class="circle two"></span>
             <span class="circle three"></span>
            
       



            
        
            </div>
</html>
    
    </div>
    
    </body>