<?php
include 'config.php';
session_start();

if(isset($_POST['signup'])){
$username=mysqli_real_escape_string($conn, $_POST['username']);
$email=mysqli_real_escape_string($conn, $_POST['email']);
$password=mysqli_real_escape_string($conn, md5($_POST['password']));

$user_type=$_POST['user_type'];

$select_users=mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password' ") or die('query failed');

if(mysqli_num_rows($select_users) >0 ){
$message[]='User already exists!';
}
else{
mysqli_query($conn,"INSERT INTO users( username,email,password,user_type) VALUES('$username','$email','$password','$user_type')") or die('query failed');
$message[]='Registered successfully!';

}

}




if(isset($_POST['login'])){
$username=mysqli_real_escape_string($conn, $_POST['username']);
$password=mysqli_real_escape_string($conn, md5($_POST['password']));


$select_users=mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password' ") or die('query failed');

if(mysqli_num_rows($select_users) >0 ){
$row=mysqli_fetch_assoc($select_users);
if($row['user_type']=='admin'){
$_SESSION['admin_username']=$row['username'];
$_SESSION['admin_email']=$row['email'];
$_SESSION['admin_id']=$row['id'];

 
}
else if($row['user_type']=='user'){
$_SESSION['user_username']=$row['username'];
$_SESSION['user_email']=$row['email'];
$_SESSION['user_id']=$row['id'];


}
 
 // Check if a redirect URL is set in the session
        if (isset($_SESSION['redirect_url'])) {
            $redirect_url = $_SESSION['redirect_url'];
            unset($_SESSION['redirect_url']); // Clear the redirect URL from the session
        } else {
            // Default redirect URLs based on user type
            $redirect_url = ($row['user_type'] == 'admin') ? 'Admin1.php' : 'Account1.php';
        }

        header('Location: ' . $redirect_url);
        exit();
}
else{
$message[]='Incorrect Username or Password!';

}

}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Log In</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="styleLogSign.css" rel="stylesheet" />


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

        });
    </script>

</head>
<body>



<?php
if(isset($message)){
foreach ($message as $message){
echo'
<div class="message">
<span>'.$message.'</span>
<i class="bx bxs-x-square" onclick="this.parentElement.remove();"></i>

</div>
';}
}
?>


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
           <li><a href="Contact.php" >contact</a></li>
<li><a href="check_login.php" class="active"><i class='bx bxs-user-account'></i> </a></li>
       </ul>
        </nav>
    </div>

   


    <div class="container" id="main">


        <div class="form-container sign-up-container">
             <form method="POST" action="#">
                <h1>Log In</h1>
                <div class="input-box">
                    <input type="text" name="username" required />
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required pattern="^(.{0,7}|[^0-9]*|[^A-Z])$"/>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>


                <button type="submit" class="btn" name="login" >Log In</button>
            </form>
        </div>

        <div class="form-container1 sign-in-container">
            <form method="POST" action="#">
                <h1>Sign Up</h1>
               <div class="input-box">
                        <input type="text" name="username" required />
                        <label>Username</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="email" required pattern="^[^@\s]+@[^@\s]+\.(com|net|org|gov|ro)$" />
                        <label>Email</label>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required pattern="^(.{0,7}|[^0-9]*|[^A-Z])$"/>
                        <label>Password</label>
                        <i class='bx bxs-lock'></i>
                    </div>
<div class="input-box">
                   <select name="user_type" class="box" required>
 <option value="" disabled selected>Select User Type</option>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                   
                    </select>
                </div>
                    <button type="submit" class="btn" name="signup" >Sign Up</button>
                  
            </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>Welcome Back!</h2>
                    <p>To keep connected with us please login with your account info</p>
                    <p1>Don't have an account?</p1>
                     <button id="logIn" class="ghost" type="button">Sign Up</button>
                </div>
                <div class="overlay-panel overlay-right">
                   <h2>Hello, Reader!</h2>
                    <p>Enter your personal details and start this journey with us</p>
                    <p1>Already have an account?</p1>
                    <button id="signUp" class="ghost" type="button">Log In</button>
                </div>
            </div>
        </div>
    </div> 

    
    <script src="script.js"></script>
</body>
</html>
