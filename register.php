<?php

include "db_connection.php";

$popupMessage = "";
$popupType = "";

if(isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkAccount = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkAccount);

    if(mysqli_num_rows($result) > 0) {
        $popupMessage = "Email already registered!";
        $popupType = "error";
    } else {
        $sql = "INSERT INTO users(name,email,password) VALUES ('$name','$email','$password')";
        
        if(mysqli_query($conn, $sql)) {
            $popupMessage = "Registration successful!";
            $popupType = "success";
        } else {
            $popupMessage = "Something went wrong!";
            $popupType = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Popup Modal (MUST be first inside body) -->
<?php if(!empty($popupMessage)): ?>
<div class="popup-overlay" id="popup">
    <div class="popup-box <?php echo $popupType; ?>">
        <div class="popup-icon">
            <?php if($popupType == "error"): ?>
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            <?php else: ?>
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            <?php endif; ?>
        </div>
        <h3><?php echo $popupMessage; ?></h3>
        <?php if($popupType == "success"): ?>
            <a href="login.php" class="popup-btn">Login Now</a>
        <?php else: ?>
            <button onclick="closePopup()" class="popup-btn">Try Again</button>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<h2>Create Account</h2>

<form method="POST">
    <label>Name</label>
    <input type="text" name="name" required placeholder="Enter your name">

    <label>Email</label>
    <input type="email" name="email" required placeholder="Enter your email">

    <label>Password</label>
    <input type="password" name="password" required placeholder="Create a password">

    <button name="register">Register</button>
</form>

<a href="login.php">Already have account? Login</a>

<script>
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
</script>

</body>
</html>