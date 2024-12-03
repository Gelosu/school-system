<?php
// Start session
session_start();

// Include database connection
require_once 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Fetch the list of users (admins) except the logged-in user
$query = "SELECT id, username FROM accounts WHERE username != :username";
$stmt = $pdo->prepare($query);
$stmt->execute(['username' => $_SESSION['user']]);
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If a chat partner is selected
$chat_with = isset($_GET['chat_with']) ? $_GET['chat_with'] : null;
$chat_with_name = null;
$messages = [];

// Fetch chat messages if a chat partner is selected
if ($chat_with) {
    // Fetch the name of the user being chatted with
    $stmt = $pdo->prepare("SELECT username FROM accounts WHERE id = :id");
    $stmt->execute(['id' => $chat_with]);
    $chat_with_name = $stmt->fetchColumn();

    // Fetch the chat messages between the logged-in user and the selected user
    $stmt = $pdo->prepare("
        SELECT m.id, m.message, m.created_at, u.username AS sender_name
        FROM messages m
        JOIN accounts u ON m.sender_id = u.id
        WHERE (m.sender_id = :user_id AND m.receiver_id = :chat_with)
        OR (m.sender_id = :chat_with AND m.receiver_id = :user_id)
        ORDER BY m.created_at ASC
    ");
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'chat_with' => $chat_with
    ]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>ISACEC - Chat</title>
</head>
<body>

    <!-- Chat Section -->
    <div class="chat-container">

        <!-- Chat List on the Left -->
        <div class="chat-list-container">
            <h3>Select a Chat</h3>
            <?php if ($admins): ?>
                <ul id="chat-list">
                    <?php foreach ($admins as $admin): ?>
                        <li>
                            <a href="javascript:void(0);" class="chat-link" data-id="<?php echo $admin['id']; ?>">
                                <?php echo htmlspecialchars($admin['username']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No admins available for chat.</p>
            <?php endif; ?>
        </div>

        <!-- Chat Box on the Right -->
        <div class="chat-box-container" id="chat-box-container">
            <?php if ($chat_with): ?>
                <div class="chat-box">
                    
                    <div class="messages">
                        <?php foreach ($messages as $msg): ?>
                            <div class="message <?php echo $msg['sender_name'] == $_SESSION['user'] ? 'sent' : 'received'; ?>">
                                <strong><?php echo htmlspecialchars($msg['sender_name']); ?>:</strong>
                                <?php echo htmlspecialchars($msg['message']); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Chat Input -->
                    <form method="post" class="chat-input" id="chat-form">
                        <input type="hidden" name="receiver" value="<?php echo htmlspecialchars($chat_with); ?>">
                        <textarea name="message" placeholder="Type your message here..." rows="3" required></textarea>
                        <button type="submit">Send</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Please select an admin to chat with.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- AJAX & JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentChatWith = '<?php echo $chat_with ?: ($admins ? $admins[0]['id'] : ''); ?>';

            // Automatically select the first user if no chat partner is selected
            if (!currentChatWith && $('#chat-list .chat-link').length > 0) {
                $('#chat-list .chat-link').first().click();
            }

          

            // Fetch chat messages
            function fetchMessages(chatWithId) {
                if (!chatWithId) return;

                $.ajax({
                    url: 'fetchmessage.php',
                    type: 'GET',
                    data: { chat_with: chatWithId },
                    dataType: 'json',
                    success: function(response) {
                        $('.messages').empty();
                        response.forEach(function(msg) {
                            const msgClass = msg.sender_name === '<?php echo $_SESSION['user']; ?>' ? 'sent' : 'received';
                            $('.messages').append(
                                `<div class="message ${msgClass}">
                                    <strong>${msg.sender_name}:</strong> ${msg.message}
                                </div>`
                            );
                        });
                        $('.messages').scrollTop($('.messages')[0].scrollHeight);
                    },
                    error: function() {
                        console.error('Error fetching messages');
                    }
                });
            }

            // Handle chat selection
            $('.chat-link').on('click', function() {
                const chatWithId = $(this).data('id');
                history.pushState(null, '', `dashboard.php?chat_with=${chatWithId}`);
                currentChatWith = chatWithId;

                // Update partner name and fetch messages
                updateChatPartnerName(chatWithId);
                fetchMessages(chatWithId);
            });

            // Handle message submission
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                const message = $('textarea[name="message"]').val();

                if (message.trim() === '') return;

                $.ajax({
                    url: 'submitmessage.php',
                    type: 'POST',
                    data: {
                        message: message,
                        receiver: currentChatWith
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('textarea[name="message"]').val('');
                            fetchMessages(currentChatWith);
                        }
                    },
                    error: function() {
                        console.error('Error sending message');
                    }
                });
            });

            // Periodic message fetching
            setInterval(() => {
                if (currentChatWith) fetchMessages(currentChatWith);
            }, 2000);

            // Initial load
            if (currentChatWith) {
                updateChatPartnerName(currentChatWith);
                fetchMessages(currentChatWith);
            }
        });
    </script>
</body>
</html>
