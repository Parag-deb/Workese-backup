<?php
session_start();
require '../connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $jobId = isset($_POST['job_id']) ? intval($_POST['job_id']) : null;
    $workerId = isset($_POST['worker_id']) ? intval($_POST['worker_id']) : null;
    $expectedSalary = isset($_POST['expected_salary']) ? floatval($_POST['expected_salary']) : null;
    $negotiationInput = isset($_POST['price']) ? floatval($_POST['price']) : null;

    // Retrieve the logged-in user's ID
    $userId = isset($_SESSION['id']) ? intval($_SESSION['id']) : null;

    echo "<script>
    console.log('Job ID: " . json_encode($jobId) . "');
    console.log('Worker ID: " . json_encode($workerId) . "'); // Log worker ID
    console.log('Expected Salary: " . json_encode($expectedSalary) . "');
    console.log('Negotiation Input: " . json_encode($negotiationInput) . "');
    console.log('User  ID: " . json_encode($userId) . "');
</script>";


    // Validate all inputs
    if (!$jobId || !$workerId || !$expectedSalary || !$negotiationInput || !$userId) {
        echo "<div class='text-red-500'>Invalid input. Please ensure all fields are filled correctly.</div>";
    
        // Log each variable to the browser console for debugging
        echo "<script>
            console.log('Job ID: " . json_encode($jobId) . "');
            console.log('Worker ID: " . json_encode($workerId) . "'); // Log worker ID
            console.log('Expected Salary: " . json_encode($expectedSalary) . "');
            console.log('Negotiation Input: " . json_encode($negotiationInput) . "');
            console.log('User  ID: " . json_encode($userId) . "');
        </script>";
    
        exit;
    }

    // Check if the worker ID exists in the workers table
    $checkWorkerSql = "SELECT worker_id FROM workers WHERE worker_id = ?";
    $checkWorkerStmt = $conn->prepare($checkWorkerSql);
    $checkWorkerStmt->bind_param("i", $workerId);
    $checkWorkerStmt->execute();
    $checkWorkerResult = $checkWorkerStmt->get_result();

    if ($checkWorkerResult->num_rows === 0) {
        echo "<div class='text-red-500'>Error: Worker ID does not exist.</div>";
        exit;
    }

    // Calculate total negotiated amount
    $negotiatedAmount = $negotiationInput;

    // Log details
    error_log("Job ID: $jobId, Worker ID: $workerId, User ID: $userId, Negotiated Amount: $negotiatedAmount");

    // Insert the negotiation into the database
    $sql = "INSERT INTO negotiations (user_id, job_id, worker_id, offer_amount, negotiated_amount) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iiidd", $userId, $jobId, $workerId, $expectedSalary, $negotiatedAmount);
        if ($stmt->execute()) {
            echo "<div class='text-green-500'>Negotiation saved successfully. Total offer: $negotiatedAmount</div>";

            // Create a notification
            $notificationMessage = "You have a new negotiation for Job ID: $jobId from User ID: $userId. Negotiated Amount: $negotiatedAmount";
            $notificationSql = "INSERT INTO notifications (worker_id, message, job_id, is_read , source) VALUES (?, ?, ?, ? , 'negotiation')";
            $notificationStmt = $conn->prepare($notificationSql);

            if ($notificationStmt) {
                $isRead = 0; // Default status for unread notification
                $notificationStmt->bind_param("issi", $workerId, $notificationMessage, $jobId, $isRead);
                if ($notificationStmt->execute()) {
                    echo "<div class='text-green-500'>Notification sent successfully to Worker ID: $workerId</div>";
                } else {
                    echo "<div class='text-red-500'>Error executing notification query: " . htmlspecialchars($notificationStmt->error) . "</div>";
                }
                $notificationStmt->close();
            } else {
                echo "<div class='text-red-500'>Error preparing notification query: " . htmlspecialchars($conn->error) . "</div>";
            }
        } else {
            echo "<div class='text-red-500'>Error executing query: " . htmlspecialchars($stmt->error) . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='text-red-500'>Error preparing query: " . htmlspecialchars($conn->error) . "</div>";
    }
} else {
    echo "<div class='text-red-500'>Invalid request method.</div>";
}
?>