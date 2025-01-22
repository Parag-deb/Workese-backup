<?php
require '../connect.php'; // Include your database connection
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_id'])) {
    $jobId = intval($_POST['job_id']); // Sanitize input to prevent SQL injection

    // Fetch job details from the database
    $sql = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $jobId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $job = $result->fetch_assoc();
            // Return job details as HTML
            echo "<h3 class='font-bold'>" . htmlspecialchars($job['job_title']) . "</h3>";
            echo "<p><strong>Company:</strong> " . htmlspecialchars($job['company_name']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($job['location']) . "</p>";
            echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($job['salary_range']) . "</p>";
            echo "<p><strong>Job Type:</strong> " . htmlspecialchars($job['job_type']) . "</p>";
            echo "<p><strong>Job Description:</strong> " . nl2br(htmlspecialchars($job['description'])) . "</p>";
            echo "<p><strong>Qualification:</strong> " . nl2br(htmlspecialchars($job['qualification'])) . "</p>";
            echo "<p><strong>Application Deadline:</strong> " . htmlspecialchars($job['application_deadline']) . "</p>";
        } else {
            echo "Job not found.";
        }

        $stmt->close(); // Close the statement
    } else {
        echo "Error preparing statement: " . $conn->error; // Error handling
    }
} else {
    echo "Invalid request."; // Handle invalid requests
}

$conn->close(); // Close the database connection
?>