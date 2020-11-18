<?php

require_once(__DIR__ . "/../config/database.php");

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$errors = [];


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email is invalidate";
}

if ($password != $password_confirmation) {
    $errors[] = "password is not thesame with password confirmation";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location:/register.php");
}

$ecryptedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (?,?,?);";

$statement = $dbConnection->prepare($sql);
$statement->bind_param('sss', $name, $email, $ecryptedPassword);
$isSuccessful = $statement->execute();

if ($isSuccessful) {
    echo "registered";
}
