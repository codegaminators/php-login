<?php

require_once(__DIR__ . "/../config/database.php");

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
        header("LOCATION:/");
}

$sql = "SELECT * FROM users WHERE email = '{$email}';";
$result = $dbConnection->query($sql);

if ($result->num_rows < 1) {
    // Return user does not exist
    die;
} 

$user =  $result->fetch_assoc();
$hashPassword = password_hash($password, PASSWORD_BCRYPT);
