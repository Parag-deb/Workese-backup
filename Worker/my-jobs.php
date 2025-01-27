<?php
session_start();
require '../connect.php';
include '../nav.php';

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $workerId = $_SESSION['id'];

    // Fetch jobs accepted by the worker
    $query = "SELECT 
                    jobs.job_title, 
                    jobs.description, 
                    jobs.salary_range, 
                    MAX(negotiations.status) AS status, 
                    jobs.created_at,
                    jobs.user_id AS employer_id 
                FROM 
                    jobs 
                JOIN 
                    negotiations 
                ON 
                    jobs.job_id = negotiations.job_id 
                WHERE 
                    negotiations.user_id = ?
                    AND negotiations.status = 'accepted'
                GROUP BY 
                    jobs.job_title, jobs.description, jobs.salary_range, jobs.created_at, jobs.user_id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $workerId);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "You need to log in to view this page.";
    exit;
}

// Handle rating submission
if (isset($_POST['submit_rating'])) {
   // $jobId = $_POST['job_id'];
    $employerId = $_POST['employer_id'];
    $workerId = $_SESSION['id'];  // The current logged-in worker
    $ratingValue = intval($_POST['rating']);
    $review = $_POST['review'];

    // Check if rating is valid
    if ($ratingValue >= 1 && $ratingValue <= 5) {
        // Insert the rating into the database
        $query = "INSERT INTO rating (worker_id, user_id,  rating_value, review, rating_date) 
                  VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        
        // Correct the bind_param with proper types
        $stmt->bind_param("iiss", $employerId, $workerId, $ratingValue, $review);
        
        if ($stmt->execute()) {
            echo "<p class='text-center text-green-500'>Rating submitted successfully!</p>";
        } else {
            echo "<p class='text-center text-red-500'>Error submitting rating.</p>";
        }
    } else {
        echo "<p class='text-center text-red-500'>Invalid rating. Please provide a rating between 1 and 5.</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Accepted Jobs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded">
        <h1 class="text-2xl font-bold mb-4">My Accepted Jobs</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php while ($job = $result->fetch_assoc()): ?>
                    <div class="border rounded p-4 shadow-sm">
                        <h2 class="text-lg font-bold"><?php echo htmlspecialchars($job['job_title']); ?></h2>
                        <p class="text-gray-600"><?php echo htmlspecialchars($job['description']); ?></p>
                        <p class="text-gray-500 mt-2">Salary: <?php echo htmlspecialchars($job['salary_range']); ?></p>
                        <p class="text-gray-500">Status: <?php echo htmlspecialchars($job['status']); ?></p>
                        <p class="text-gray-400 text-sm mt-2">Posted on: <?php echo htmlspecialchars($job['created_at']); ?></p>

                        <!-- Rating Form -->
                        <form method="POST" action="" class="mt-4">
                            
                            <input type="hidden" name="employer_id" value="<?php echo $job['employer_id']; ?>">
                            <div class="flex items-center space-x-2">
                                <select name="rating" required class="border px-2 py-1 rounded">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <input type="text" name="review" placeholder="Leave a review" class="border px-2 py-1 rounded">
                                <button type="submit" name="submit_rating" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Rating</button>
                            </div>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">You have not accepted any jobs yet.</p>
        <?php endif; ?>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
