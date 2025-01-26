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
                    jobs.created_at 
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
                    jobs.job_title, jobs.description, jobs.salary_range, jobs.created_at";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $workerId);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "You need to log in to view this page.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs</title>
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
