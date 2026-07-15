<?php
require_once '../utils/DBWrapper.php';
require_once '../models/user.php';

if (isset($_POST['email']) && filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    $email = trim($_POST['email']);
    $user = new User();

    if ($user->emailExists($email)) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
    exit();
}

echo json_encode(['exists' => false, 'invalid' => true]);

