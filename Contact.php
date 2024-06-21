<?php
include 'config.php';
session_start();


?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
     <title>Contact</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="styleContact1.css" rel="stylesheet" />

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
const inputs = document.querySelectorAll(".input");
        inputs.forEach(input => {
            input.addEventListener('focus', focusFunc);
            input.addEventListener('blur', blurFunc);
        });
    });

    function focusFunc() {
        let parent = this.parentNode;
        parent.classList.add("focus");
    }

    function blurFunc() {
        let parent = this.parentNode;
        if (this.value == "") {
            parent.classList.remove("focus");
        }
    }


      
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
           <li><a href="AboutUs.php" >about</a></li>
           <li><a href="SearchBook.php" >books</a></li>
           <li><a href="Contact.php" class="active">contact</a></li>
<li><a href="check_login.php"><i class='bx bxs-user-account'></i> </a></li>
       </ul>
        </nav>
    </div>

    <div class="container">
        <span class="big-circle"></span>
        <div class="form">
            <div class="contact-info">
                 <h3 class="title1">Let's get in touch! </h3>
                <p class="text">
                    We'd love to hear from you! Whether you have a question, a suggestion, or just want to say hello, fill out the form or use the contact details to get in touch with us. We're here to help!

                </p>

                <div class="info">
                    <div class="information">
                        <i class='bx bxs-envelope' ></i>
                       
                        <p>BookFormation@protonmail.com</p>
                    </div>

                    <div class="information">
                         <i class='bx bxs-phone' ></i>
                        
                        <p>0737-564-441</p>
                    </div>
                </div>
                </div>



            <div class="contact-form">
                <span class="circle one"></span>
                 <span class="circle two"></span>

                <form action="https://api.web3forms.com/submit" method="POST">
                    <h3 class="title">Contact us </h3>
                    <input type="hidden" name="access_key" value="3bc5dc26-63a7-4235-8f7c-3b86087483d9">
                    <div class="input-container">
                        <input type="text" name="name" id="name" class="input" required>
                        <label for="name">Username</label>
                        <span>Username</span>
                        
                        
                    </div>


                    <div class="input-container">
                        <input type="email"  id="email" name="email" class="input" required pattern="^[^@\s]+@[^@\s]+\.(com|net|org|gov|ro)$">
                        <label for="email">email</label>
                        <span>Email</span>
                    </div>

                    <div class="input-container">
                        <input type="tel" id="phone" name="phone" class="input" required pattern="^(\+4)?07\d{8}$">
                        <label for="phone">Phone</label>
                        <span>Phone</span>
                    </div>

                    <div class="input-container textarea">
                        <textarea name="message" id="message" class="input" required></textarea>
                        <label for="message">Message</label>
                        <span>Message</span>
                    </div>

                    <input type="submit" value="Send Message" class="btn" onclick="openPopup()"/>
                  
                    
                    
                </form>
            </div>
        </div>
    </div>
 
</body>
</html>
