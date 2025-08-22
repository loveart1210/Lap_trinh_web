<?php
function handleFormSubmission() {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $invoice = trim($_POST['invoice'] ?? '');
    $additional = trim($_POST['additional'] ?? '');
    $payFor = $_POST['pay_for'] ?? [];
    $errors = [];
    $uploadedFile = '';

    if (empty($firstName)) $errors[] = 'Họ là bắt buộc.';
    if (empty($lastName)) $errors[] = 'Tên là bắt buộc.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email hợp lệ là bắt buộc.';
    if (empty($invoice)) $errors[] = 'Mã hóa đơn là bắt buộc.';
    if (empty($payFor)) $errors[] = 'Ít nhất một tùy chọn Pay For là bắt buộc.';

    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === 0) {
        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
        $fileType = mime_content_type($_FILES['receipt']['tmp_name']);
        $fileExt = strtolower(pathinfo($_FILES['receipt']['name'], PATHINFO_EXTENSION));
        if (in_array($fileType, $allowedTypes) && in_array($fileExt, ['png', 'jpg', 'jpeg', 'gif'])) {
            $uploadedFile = UPLOAD_DIR . basename($_FILES['receipt']['name']);
            if (!move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadedFile)) {
                $errors[] = 'Tải file thất bại.';
            }
        } else {
            $errors[] = 'Loại file không hợp lệ. Chỉ cho phép PNG, JPG, JPEG, GIF.';
        }
    } else {
        $errors[] = 'Vui lòng tải lên biên lai thanh toán.';
    }

    return [$firstName, $lastName, $email, $invoice, $additional, $payFor, $errors, $uploadedFile];
}

function storeUserData($firstName, $lastName, $email, $invoice, $payFor, $additional, $uploadedFile) {
    setcookie('first_name', $firstName, time() + 3600, '/');
    setcookie('last_name', $lastName, time() + 3600, '/');
    $_SESSION['email'] = $email;
    $_SESSION['invoice'] = $invoice;
    $_SESSION['pay_for'] = $payFor;
    $_SESSION['additional'] = $additional;
    $_SESSION['uploaded_file'] = $uploadedFile;
}

function getUserData() {
    $firstName = $_COOKIE['first_name'] ?? '';
    $lastName = $_COOKIE['last_name'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $invoice = $_SESSION['invoice'] ?? '';
    $payFor = $_SESSION['pay_for'] ?? [];
    $additional = $_SESSION['additional'] ?? '';
    $uploadedFile = $_SESSION['uploaded_file'] ?? '';
    return [$firstName, $lastName, $email, $invoice, $payFor, $additional, $uploadedFile];
}
?>