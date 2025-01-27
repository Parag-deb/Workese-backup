<?php
include '../connect.php'; // Include database connection
session_start();
include 'header.php';
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']);
    
    // Fetch the job details
    $query = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "Job not found.";
        $_SESSION['message_type'] = "error";
        header("Location: job-management.php");
        exit();
    }
} else {
    header("Location: job-management.php");
    exit();
}

// Update job details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_title = $_POST['job_title'];
    $category_id = $_POST['category_id'];
    $job_type = $_POST['job_type'];
    $job_post_date = $_POST['job_post_date'];
    $location = $_POST['location'];

    $update_query = "UPDATE jobs SET job_title = ?, category_id = ?, job_type = ?, job_post_date = ?, location = ? WHERE job_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssi", $job_title, $category_id, $job_type, $job_post_date, $location, $job_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Job updated successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: job-management.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update the job.";
        $_SESSION['message_type'] = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Job</h1>
    
    <!-- Edit Form -->
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="job_title" class="block text-gray-700">Job Title</label>
            <input type="text" name="job_title" id="job_title" value="<?php echo htmlspecialchars($job['job_title']); ?>" class="w-full p-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Category</label>
            <input type="text" name="category_id" id="category_id" value="<?php echo htmlspecialchars($job['category_id']); ?>" class="w-full p-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="job_type" class="block text-gray-700">Job Type</label>
            <input type="text" name="job_type" id="job_type" value="<?php echo htmlspecialchars($job['job_type']); ?>" class="w-full p-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="job_post_date" class="block text-gray-700">Job Post Date</label>
            <input type="date" name="job_post_date" id="job_post_date" value="<?php echo htmlspecialchars($job['job_post_date']); ?>" class="w-full p-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-gray-700">Location</label>
            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($job['location']); ?>" class="w-full p-2 border rounded-lg" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Update Job</button>
        <a href="job-management.php" class="ml-4 text-gray-600">Cancel</a>
    </form>
</div>
</body>
</html>
