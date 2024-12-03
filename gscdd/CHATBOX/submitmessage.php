<?php
// Start session
session_start();

// Include database connection
require_once 'chatconnection.php';

// Set the user id as 2 (logged-in user)
$sender_id = 2; // Hardcoded as user with id = 2

// Check if message and receiver are set
if (isset($_POST['message']) && isset($_POST['receiver'])) {
    $message = $_POST['message'];
    $receiver_id = $_POST['receiver'];

    // Insert the message into the database
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
    $stmt->execute([
        'sender_id' => $sender_id, // Sender is the user with id=2
        'receiver_id' => $receiver_id,
        'message' => $message
    ]);

    // Respond with success
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['error' => 'Message or receiver not set']);
}
?>
