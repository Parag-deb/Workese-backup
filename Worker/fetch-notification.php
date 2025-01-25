<?php
session_start(); // Start the session
require '../connect.php'; // Database connection

echo "<script>console.log('Session started and database connected.');</script>";

// Use user ID and role from POST or fallback to session
$userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : (isset($_SESSION['id']) ? intval($_SESSION['id']) : null);
$userRole = isset($_POST['role']) ? $_POST['role'] : (isset($_SESSION['role']) ? $_SESSION['role'] : null);

echo "<script>console.log('User  ID: " . htmlspecialchars(json_encode($userId)) . ", User Role: " . htmlspecialchars(json_encode($userRole)) . "');</script>";

if ($userId && $userRole) {
    if ($userRole === 'worker') {
        // SQL query to fetch notifications for workers
        $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.job_title AS job_title 
                            FROM notifications
                            JOIN workers ON notifications.worker_id = workers.worker_id
                            JOIN users ON workers.user_id = users.id
                            JOIN jobs ON notifications.job_id = jobs.job_id
                            WHERE workers.user_id = ? AND notifications.is_read = FALSE 
                            ORDER BY notifications.created_at DESC";

        echo "<script>console.log('Query for workers: " . addslashes($notificationSql) . "');</script>";
    } elseif ($userRole === 'recruiter') {
        // SQL query to fetch notifications for recruiters
        $notificationSql = "SELECT notifications.*, jobs.job_id, jobs.job_title 
                            FROM notifications
                            LEFT JOIN jobs ON notifications.job_id = jobs.job_id
                            WHERE notifications.recruiter_id = ? AND notifications.is_read = FALSE 
                            ORDER BY notifications.created_at DESC";

        echo "<script>console.log('Query for recruiters: " . addslashes($notificationSql) . "');</script>";
    } else {
        echo "<script>console.error('Invalid user role.');</script>";
        exit;
    }

    $notificationStmt = $conn->prepare($notificationSql);

    if (!$notificationStmt) {
        echo "<script>console.error('Error preparing statement: " . htmlspecialchars($conn->error) . "');</script>";
        exit;
    }

    $notificationStmt->bind_param("i", $userId);
    echo "<script>console.log('Statement prepared and parameter bound with User ID: $userId');</script>";

    if (!$notificationStmt->execute()) {
        echo "<script>console.error('Error executing statement: " . htmlspecialchars($notificationStmt->error) . "');</script>";
        exit;
    }

    $notifications = $notificationStmt->get_result();
    echo "<script>console.log('Number of notifications fetched: " . $notifications->num_rows . "');</script>";

    if ($notifications->num_rows > 0) {
        while ($notification = $notifications->fetch_assoc()) {
            echo "<script>console.log('Notification: " . json_encode($notification) . "');</script>";

            // Check the source of the notification
            $source = isset($notification['source']) ? htmlspecialchars($notification['source']) : 'Unknown Source';

            if ($source === 'negotiation') {
                // Redirect to negotiation details page
                echo '<a href="negotiation-details.php?job_id=' . htmlspecialchars($notification['job_id']) . '" class="p-2 border rounded hover:bg-gray-100 block">
                        ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) . ') (Source: ' . $source . ') (Created At: ' . htmlspecialchars($notification['created_at']) . ')
                      </a>';
            } elseif ($userRole === 'recruiter' && isset($notification['job_id'])) {
                echo '<a href="notification-details.php?job_id=' . htmlspecialchars($notification['job_id']) . '" target="_blank" class="p-2 border rounded hover:bg-gray-100 block">
                        ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) . ') (Source: ' . $source . ') (Created At: ' . htmlspecialchars($notification['created_at']) . ')
                      </a>';
            } else {
                echo '<a href="job-details.php?job_id=' . htmlspecialchars($notification['job_id']) . '" class="p-2 border rounded hover:bg-gray-100 block">
                        ' . htmlspecialchars($notification['message']) . ' (Job: ' . htmlspecialchars($notification['job_title']) . ') (Source: ' . $source . ') (Created At: ' . htmlspecialchars($notification['created_at']) . ')
                      </a>';
            }
        }
    } else {
        echo "<script>console.log('No new notifications.');</script>";
        echo '<div class="text-gray-500">No new notifications.</div>';
    }

    $notificationStmt->close();
} else {
    echo "<script>console.error('User  ID or role not provided.');</script>";
    echo '<div>POST Data: ' . htmlspecialchars(json_encode($_POST)) . '</div>';
    echo '<div>Session Data: ' . htmlspecialchars(json_encode($_SESSION)) . '</div>';
}
?>