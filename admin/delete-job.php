<?php
include '../connect.php'; // Include database connection
session_start();

if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']);

    // Delete query
    $query = "DELETE FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Job deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete the job.";
        $_SESSION['message_type'] = "error";
    }
    header("Location: job-management.php");
    exit();
} else {
    header("Location: job-management.php");
    exit();
}
?>
