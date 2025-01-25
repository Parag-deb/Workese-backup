<?php
require '../connect.php'; // Database connection

$jobId = isset($_GET['job_id']) ? intval($_GET['job_id']) : null;

if ($jobId) {
    $sql = "SELECT negotiations.*, jobs.*, workers.* 
            FROM jobs
            JOIN negotiations ON jobs.job_id = negotiations.job_id
            JOIN workers ON negotiations.worker_id = workers.worker_id
            WHERE jobs.job_id = ?
            ORDER BY negotiations.created_at DESC
            LIMIT 1";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $jobId);

    if (!$stmt->execute()) {
        die("Error executing statement: " . htmlspecialchars($stmt->error));
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Notification Details</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100 p-6">
            <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Notification Details for Job ID: ' . htmlspecialchars($jobId) . '</h1>';
        
        $row = $result->fetch_assoc();
        $workerId = htmlspecialchars($row['worker_id']);
        $expectedSalary = htmlspecialchars($row['negotiated_amount']);
        
        // JavaScript to log worker_id and expected_salary to the console
        echo "<script>console.log('Worker ID: " . $workerId . "');</script>";
        echo "<script>console.log('Expected Salary: " . $expectedSalary . "');</script>";

        echo '<div class="p-4 border mb-2">
                <p><strong>Job Title:</strong> ' . htmlspecialchars($row['job_title']) . '</p>
                <p><strong>Negotiated Amount:</strong> ' . htmlspecialchars($row['negotiated_amount']) . '</p>
                <p><strong>Created At:</strong> ' . htmlspecialchars($row['created_at']) . '</p>
                <form action="handle-negotiation.php" method="POST" class="mt-4">
                    <input type="hidden" name="job_id" value="' . htmlspecialchars($jobId) . '">
                    <input type="hidden" name="worker_id" value="' . htmlspecialchars($row['worker_id']) . '">
                    <input type="hidden" name="expected_salary" value="' . htmlspecialchars($row['negotiated_amount']) . '">
                    
                    <div class="flex space-x-2">
                        <!-- Accept Button -->
                        <button type="submit" name="action" value="accept" class="bg-green-500 text-white py-2 px-4 rounded">Accept</button>
                        <!-- Decline Button -->
                        <button type="submit" name="action" value="decline" class="bg-red-500 text-white py-2 px-4 rounded">Decline</button>
                        <!-- Negotiation Input -->
                        <input type="number" name="price" placeholder="Negotiation Price" class="border p-2 rounded" required>
                        <!-- Negotiate Button -->
                        <button type="submit" name="action" value="negotiate" class="bg-blue-500 text-white py-2 px-4 rounded">Negotiate</button>
                    </div>
                </form>
              </div>';

        echo '</div>
        </body>
        </html>';
    } else {
        echo '<div class="text-gray-500">No negotiations found for this job.</div>';
    }

    $stmt->close();
} else {
    echo '<div class="text-red-500">Job ID not provided.</div>';
}
?>