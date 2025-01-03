<?php
require_once './utils/DBWrapper.php';
require_once './repositories/UserWorkshop.php';
require_once './repositories/ManageUsers.php';

// Check if user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
    $userId = $currentUser['U_ID'];
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get workshop ID from URL
$workshopId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($workshopId && $userId) {
    // Create an instance of UserWorkshop
    $userWorkshop = new UserWorkshop();
    $manageUsers = new ManageUsers();

    // Insert entry into userworkshop table
    if ($userWorkshop->createUserWorkshop($userId, $workshopId)) {
        // Redirect to workshop details page or a success page
        header("Location: workshops.php");
        exit();
    } else {
        // Handle error
        echo "Failed to register for the workshop.";
    }
} else {
    // Handle invalid workshop ID or user ID
    echo "Invalid workshop ID or user ID.";
}
?>