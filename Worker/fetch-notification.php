<?php
//session_start(); // Ensure session is started
require '../connect.php'; // Database connection

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']); // Sanitize user ID
    echo "User  ID: " . htmlspecialchars($userId) . "<br>"; // Debugging output

    // SQL query to fetch notifications for the user
    $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.title AS job_title 
                         FROM notifications
                         JOIN workers ON notifications.worker_id = workers.worker_id
                         JOIN users ON workers.user_id = users.id
                         JOIN jobs ON notifications.job_id = jobs.job_id
                         WHERE workers.user_id = ? ";

    $notificationStmt = $conn->prepare($notificationSql);
    
    if (!$notificationStmt) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error) . "<br>"; // Debugging output
        exit;
    }

    $notificationStmt->bind_param("i", $userId);
    
    if (!$notificationStmt->execute()) {
        echo "Error executing statement: " . htmlspecialchars($notificationStmt->error) . "<br>"; // Debugging output
        exit;
    }

    $notifications = $notificationStmt->get_result();
    if (!$notificationStmt->get_result()) {
        echo "Error executing statement: " . htmlspecialchars($notifications->error) . "<br>"; // Debugging output
        exit;
    }

    if ($notifications->num_rows > 0) {
        while ($notification = $notifications->fetch_assoc()) {
            echo '<div class="p-2 border rounded hover:bg-gray-100 cursor-pointer" 
                    onclick="openNotificationDetail(' . htmlspecialchars($notification['id']) . ', ' . htmlspecialchars($notification['job_id']) . ')">
                    ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) . ')
                  </div>';
        }
    } else {
        echo '<div class="text-gray-500">No new notifications.</div>';
    }

    $notificationStmt->close();
} 
else {
    echo '<div class="text-red-500">User  ID not provided.</div>';
}

?>
<script>
        // Print the session variable to the console
        var userId = <?php echo json_encode($_SESSION['id']); ?>; // Pass the session variable to JavaScript
    console.log("User  ID from session: ", userId);
</script>