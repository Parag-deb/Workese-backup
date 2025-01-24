<?php
session_start();
require '../connect.php'; // Database connection

// Helper function for logging to the browser console
function console_log($message) {
    echo "<script>console.log(" . json_encode($message) . ");</script>";
}

// Log the start of the script
console_log("Starting Job Action script");

// Fetch job ID and source from the URL
$jobId = isset($_GET['job_id']) ? intval($_GET['job_id']) : null;
$source = isset($_GET['source']) ? $_GET['source'] : null;

// Log the job ID and source
console_log("Job ID: " . ($jobId !== null ? $jobId : "null"));
console_log("Source: " . ($source !== null ? $source : "null"));

// Check if job ID and source are provided
if (!$jobId) {
    console_log("Error: Invalid job ID or source.");
    echo '<div class="text-red-500">Invalid job ID or source.</div>';
    exit;
}

// Fetch worker details for the specific job
$workerDetailsSql = "SELECT * FROM jobapplications 
                     JOIN 
                     users ON jobapplications.worker_id = users.id
                     JOIN
                     workers ON users.id = workers.user_id
                     WHERE jobapplications.job_id = ?";
console_log("SQL Query: " . $workerDetailsSql);

$workerStmt = $conn->prepare($workerDetailsSql);

if (!$workerStmt) {
    console_log("Error preparing statement: " . $conn->error);
    echo "Error preparing statement: " . htmlspecialchars($conn->error);
    exit;
}

$workerStmt->bind_param("i", $jobId);
console_log("Bind param: job_id = " . $jobId);

if (!$workerStmt->execute()) {
    console_log("Error executing statement: " . $workerStmt->error);
    echo "Error executing statement: " . htmlspecialchars($workerStmt->error);
    exit;
}

$workerDetails = $workerStmt->get_result();
console_log("SQL executed successfully. Number of rows: " . $workerDetails->num_rows);

if ($workerDetails->num_rows > 0) {
    $worker = $workerDetails->fetch_assoc();
    console_log("Worker details fetched: " . json_encode($worker));
} else {
    console_log("No worker details found for this job.");
    echo '<div class="text-red-500">No worker details found for this job.</div>';
    exit;
}

$workerStmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Action</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Job Action</h1>

        <!-- Worker Details -->
        <div class="border-b pb-4 mb-4">
            <h2 class="text-xl font-semibold mb-2">Worker Details</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($worker['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($worker['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($worker['phone']); ?></p>
            <p><strong>Experience:</strong> <?php echo htmlspecialchars($worker['experience']); ?> years</p>
            <p><strong>Skills:</strong> <?php echo htmlspecialchars($worker['skills']); ?></p>
            <p><strong>Expected Salary:</strong> <?php echo htmlspecialchars($worker['expected_salary']); ?></p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between">
            <!-- Accept Button -->
            <form action="handle-action.php" method="POST" class="inline-block">
                <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($jobId); ?>">
                <input type="hidden" name="worker_id" value="<?php echo htmlspecialchars($worker['worker_id']); ?>">
                <input type="hidden" name="action" value="accept">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Accept</button>
            </form>

            <!-- Decline Button -->
            <form action="handle-action.php" method="POST" class="inline-block">
                <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($jobId); ?>">
                <input type="hidden" name="worker_id" value="<?php echo htmlspecialchars($worker['worker_id']); ?>">
                <input type="hidden" name="action" value="decline">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Decline</button>
            </form>

            <!-- Negotiate Button -->

<!-- Negotiate Button with Price Input -->
<form action="negotiate.php" method="POST" class="inline-block flex items-center space-x-2">
    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($jobId); ?>">
    <input type="hidden" name="worker_id" value="<?php echo htmlspecialchars($worker['worker_id']); ?>">
    <input type="hidden" name="expected_salary" value="<?php echo htmlspecialchars($worker['expected_salary']); ?>">
    <!-- Price Input -->
    <input 
        type="number" 
        name="price" 
        placeholder="Enter price" 
        class="border px-2 py-1 rounded text-gray-700" 
        required>
    
    <!-- Negotiate Button -->
    <button 
        type="submit" 
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Negotiate
    </button>
</form>
        </div>
    </div>
</body>
</html>
