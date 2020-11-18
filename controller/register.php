<?php

require_once(__DIR__ . "/../config/database.php");

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirmation = trim($_POST['password_confirmation']);

$errors = [];

if (
    empty($name) ||
    empty($email) ||
    empty($password) || 
    empty($password_confirmation)
) {
    $errors[] = 'All fields are required';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email';
}

if ($password !== $password_confirmation) {
    $errors[] = 'Password and password confirmation should be the same';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("LOCATION:/register.php");
}

$ecryptedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (?,?,?)";

$statement = $dbConnection->prepare($sql);
$statement->bind_param('sss', $name, $email, $ecryptedPassword);

if ($statement->execute()) {
    echo " Success";
} else {
    $_SESSION['errors'][] = 'Something went wrong';
    header("LOCATION:/register.php");
}
