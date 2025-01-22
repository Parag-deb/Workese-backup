<?php
//session_start();
require '../connect.php'; // Database connection

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']); // Sanitize user ID

    // SQL query to fetch notifications for the user
    $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.job_title AS job_title 
                         FROM notifications
                         JOIN workers ON notifications.worker_id = workers.worker_id
                         JOIN users ON workers.user_id = users.id
                         JOIN jobs ON notifications.job_id = jobs.job_id
                         WHERE workers.user_id = ? AND notifications.is_read = FALSE";

    $notificationStmt = $conn->prepare($notificationSql);
    $notificationStmt->bind_param("i", $userId);
    $notificationStmt->execute();
    $notifications = $notificationStmt->get_result();

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
} else {
    echo '<div class="text-red-500">User  ID not provided.</div>';
}
?>