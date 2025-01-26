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
            users.id AS employer_id, 
            users.name, 
            users.email, 
            users.phone, 
            users.division, 
            users.district, 
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
                </tr>
            </thead>
            <tbody>
                <?php while ($worker = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['name']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['email']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['phone']); ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($worker['division'] . ', ' . $worker['district']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['job_title']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['created_at']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($worker['status']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
