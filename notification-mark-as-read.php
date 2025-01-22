<?php
require 'connect.php'; // Database connection
session_start(); // Start the session

if (isset($_GET['notification_id']) && isset($_GET['job_id'])) {
    $notificationId = intval($_GET['notification_id']); // Sanitize notification ID
    $jobId = intval($_GET['job_id']); // Sanitize job ID

    // Update the notification status to read
    $updateSql = "UPDATE notifications SET is_read = TRUE WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    
    if (!$updateStmt) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
        exit;
    }

    $updateStmt->bind_param("i", $notificationId);

    if (!$updateStmt->execute()) {
        echo "Error executing statement: " . htmlspecialchars($updateStmt->error);
        exit;
    }

    $updateStmt->close();

    // Redirect to the job details page
    header("Location: job-details.php?job_id=" . $jobId);
    exit;
} else {
    echo "Notification ID or Job ID not provided.";
}
?>