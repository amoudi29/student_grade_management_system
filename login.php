<?php

session_start();

include "db_connection.php";

$popupMessage = "";
$popupType = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user'] = $user['name'];
            header("Location:dashboard.php");
            exit();

        }else{
            $popupMessage = "Wrong password!";
            $popupType = "error";
        }

    }else{
        $popupMessage = "Account not found!";
        $popupType = "error";
    }

}

?>

<!DOCTYPE html>
<html>

<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Popup Modal -->
<?php if(!empty($popupMessage)): ?>
<div class="popup-overlay" id="popup">
    <div class="popup-box <?php echo $popupType; ?>">
        <div class="popup-icon">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <h3><?php echo $popupMessage; ?></h3>
        <button onclick="closePopup()" class="popup-btn">Try Again</button>
    </div>
</div>
<?php endif; ?>

<h2>Login</h2>

<form method="POST">

    <label>Email</label>
    <input type="email" name="email" required placeholder="Enter your email">

    <label>Password</label>
    <input type="password" name="password" required placeholder="Enter your password">

    <button name="login">Login</button>

</form>

<a href="register.php">Create Account</a>

<script>
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
</script>

</body>

</html>