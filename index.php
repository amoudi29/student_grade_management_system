<?php

include __DIR__ . "/db_connection.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Database</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Student Management System</h1>

<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>


</body>
</html>