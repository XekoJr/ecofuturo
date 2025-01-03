<?php
require_once './utils/DBWrapper.php';
require_once './models/user.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $user = new User();

    if ($user->emailExists($email)) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
    exit();
}
?>

