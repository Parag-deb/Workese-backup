<?php
session_start();
require '../connect.php';
include '../nav.php';

// Check if the employer is logged in
if (!isset($_SESSION['id'])) {
    echo "You must log in to view this page.";
    exit;
}

$employerId = intval($_SESSION['id']); // Employer's user ID from session

// Fetch workers assigned to this employer
$query = "SELECT 
            jobs.job_id,
            users.id AS worker_id, 
            users.name AS worker_name, 
            users.email AS worker_email, 
            users.phone AS worker_phone, 
            users.division AS worker_division, 
            users.district AS worker_district, 
            jobs.job_title, 
            jobs.created_at, 
            jobapplications.worker_id, 
            negotiations.status 
        FROM jobs 
        JOIN negotiations 
            ON jobs.job_id = negotiations.job_id 
        INNER JOIN jobapplications 
            ON jobs.job_id = jobapplications.job_id 
        INNER JOIN users 
            ON jobapplications.worker_id = users.id 
        WHERE jobs.user_id = ? 
        AND negotiations.status = 'accepted'
        GROUP BY jobs.job_id";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employerId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p class='text-center text-gray-500'>No workers are assigned to you.</p>";
    exit;
}

// Handle rating submission
if (isset($_POST['submit_rating'])) {
    $workerId = $_POST['worker_id']; // The worker's ID
    $ratingValue = intval($_POST['rating']);
    $review = $_POST['review'];

    // Check if the worker exists in the database
    $checkWorkerQuery = "SELECT 1 FROM users WHERE id = ?";
    $checkStmt = $conn->prepare($checkWorkerQuery);
    $checkStmt->bind_param("i", $workerId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Worker exists, proceed with the rating insertion
        if ($ratingValue >= 1 && $ratingValue <= 5) {
            $query = "INSERT INTO rating (user_id, worker_id, rating_value, review, rating_date) 
                      VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iiis", $employerId, $workerId, $ratingValue, $review);
            if ($stmt->execute()) {
                echo "<p class='text-center text-green-500'>Rating submitted successfully!</p>";
            } else {
                echo "<p class='text-center text-red-500'>Error submitting rating.</p>";
            }
        } else {
            echo "<p class='text-center text-red-500'>Invalid rating. Please provide a rating between 1 and 5.</p>";
        }
    } else {
        echo "<p class='text-center text-red-500'>Invalid worker. Please try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Workers Under Me</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded">
        <h2 class="text-2xl font-bold mb-4">My Workers</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Worker Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Location</th>
                    <th class="border border-gray-300 px-4 py-2">Job Title</th>
                    <th class="border border-gray-300 px-4 py-2">Start Date</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($worker = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['worker_name']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['worker_email']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['worker_phone']); ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($worker['worker_division'] . ', ' . $worker['worker_district']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['job_title']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['created_at']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['status']); ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form method="POST" action="">
                                <input type="hidden" name="worker_id" value="<?php echo $worker['worker_id']; ?>">

                                <div class="flex items-center space-x-2">
                                    <!-- Rating select -->
                                    <select name="rating" required class="bg-white border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <!-- Review input -->
                                    <input type="text" name="review" placeholder="Leave a review" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64" />

                                    <!-- Submit button -->
                                    <button type="submit" name="submit_rating" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit Rating</button>
                                </div>
                            </form>
                        </td>

                    </tr>

                    <!-- Log data to the console -->
                    <script>
                        console.log('Employer ID: <?php echo $employerId; ?>');
                        console.log('Worker ID: <?php echo $worker['worker_id']; ?>');
                        console.log('Worker Name: <?php echo htmlspecialchars($worker['worker_name']); ?>');
                        console.log('Worker Email: <?php echo htmlspecialchars($worker['worker_email']); ?>');
                        console.log('Worker Phone: <?php echo htmlspecialchars($worker['worker_phone']); ?>');
                        console.log('Worker Location: <?php echo htmlspecialchars($worker['worker_division'] . ', ' . $worker['worker_district']); ?>');
                    </script>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
