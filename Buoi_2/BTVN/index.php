<?php
session_start();

// Include config and functions
require_once 'config.php';
require_once 'functions.php';

$firstName = $lastName = $email = $invoice = $additional = '';
$payFor = [];
$errors = [];
$uploadedFile = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    list($firstName, $lastName, $email, $invoice, $additional, $payFor, $errors, $uploadedFile) = handleFormSubmission();
    if (empty($errors)) {
        storeUserData($firstName, $lastName, $email, $invoice, $payFor, $additional, $uploadedFile);
    }
}

// Retrieve data
list($firstName, $lastName, $email, $invoice, $payFor, $additional, $uploadedFile) = getUserData();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Upload Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'form.php'; ?>
    <?php include 'display.php'; ?>
</body>
</html>