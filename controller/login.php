<?php


require_once(__DIR__ . "/../config/database.php");

$errors = [];
$email = $_POST['email'];
$password =  $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid Email Provided';
    $_SESSION['errors'] = $errors;
    header("Location:/index.php");
}
$sql = "SELECT * FROM users WHERE email='{$email}'";

$result = $dbConnection->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        echo "logged in";
    } else {
        $errors[] = "incorrect password";
        $_SESSION['errors'] = $errors;
        header("Location:/index.php");
    }
} else {
    $errors[] = "User does not exist";
    $_SESSION['errors'] = $errors;
    header("Location:/index.php");
}
