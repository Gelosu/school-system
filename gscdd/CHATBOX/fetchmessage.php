<?php
// Start session
session_start();

// Include database connection
require_once 'chatconnection.php';

// Set user id as 2 (logged-in user)
$user_id = 2; // Hardcoded as user with id = 2

// Fetch the username of the logged-in user (id=2) from the accounts table
$stmt = $pdo->prepare("SELECT username FROM accounts WHERE id = :user_id LIMIT 1");
$stmt->execute(['user_id' => $user_id]);
$username = $stmt->fetchColumn();

// If no username found for this user (id=2), exit with an error
if (!$username) {
    echo json_encode(['error' => 'User not found']);
    exit();
}

// Get the selected chat partner (receiver) from the query string
$chat_with = isset($_GET['chat_with']) ? $_GET['chat_with'] : null;
if (!$chat_with) {
    echo json_encode(['error' => 'No chat partner selected']);
    exit();
}

// Fetch messages between the logged-in user (id=2) and the selected user
$stmt = $pdo->prepare("
    SELECT m.id, m.message, m.created_at, u.username AS sender_name
    FROM messages m
    JOIN accounts u ON m.sender_id = u.id
    WHERE (m.sender_id = :user_id AND m.receiver_id = :chat_with)
    OR (m.sender_id = :chat_with AND m.receiver_id = :user_id)
    ORDER BY m.created_at ASC
");
$stmt->execute([
    'user_id' => $user_id, // Logged-in user with id=2
    'chat_with' => $chat_with
]);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return messages as JSON
echo json_encode($messages);
?>