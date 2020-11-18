<?php

require_once(__DIR__ . "/../config/database.php");
unset($_SESSION['errors']);

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$errors = [];

if (empty($email) || empty($password)) {
    $errors[] = 'Email and password is required';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    return header("LOCATION:/");
}

$sql = "SELECT * FROM users WHERE email = '{$email}';";
$result = $dbConnection->query($sql);

if (!$result->num_rows) {
    $errors[] = 'user does not exist';
    $_SESSION['errors'] = $errors;
    return header("LOCATION:/");
}

$user =  $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    $errors[] = ' invalid credentials';
    $_SESSION['errors'] = $errors;
    return header("LOCATION:/");
}

$_SESSION['is_logged_in'] = true;
echo " Logged In";