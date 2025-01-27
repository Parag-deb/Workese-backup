<?php
include '../connect.php'; // Include database connection
include 'header.php';
session_start();

// Fetch jobs from the database
$query = "SELECT * FROM jobs ORDER BY job_post_date DESC";
$result = $conn->query($query);

// Fetch distinct job types and locations for filtering
$jobTypes = $conn->query("SELECT DISTINCT job_type FROM jobs");
$locations = $conn->query("SELECT DISTINCT location FROM jobs");

$filters = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Apply filters
    $query = "SELECT * FROM jobs WHERE 1=1";
    if (!empty($_GET['job_type'])) {
        $filters['job_type'] = $_GET['job_type'];
        $query .= " AND job_type = '" . $conn->real_escape_string($_GET['job_type']) . "'";
    }
    if (!empty($_GET['location'])) {
        $filters['location'] = $_GET['location'];
        $query .= " AND location = '" . $conn->real_escape_string($_GET['location']) . "'";
    }
    if (!empty($_GET['sort'])) {
        $sort = $_GET['sort'] === 'oldest' ? 'ASC' : 'DESC';
        $query .= " ORDER BY job_post_date $sort";
    } else {
        $query .= " ORDER BY job_post_date DESC";
    }
    $result = $conn->query($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<div class="w-64 bg-white shadow-md">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
            <ul class="mt-4">
                <li><a href="admin-home.php" class="sidebar-link block p-4 text-gray-700">Dashboard</a></li>
                <li><a href="user-management.php" class="sidebar-link block p-4 text-gray-700 bg-gray-200">User Management</a></li>
                <li><a href="job-management.php" class="sidebar-link block p-4 text-gray-700">Job Management</a></li>
                <li><a href="negotiation-management.php" class="sidebar-link block p-4 text-gray-700">Negotiation Management</a></li>
                <li><a href="reports.php" class="sidebar-link block p-4 text-gray-700">Reports</a></li>
                <li><a href="settings.php" class="sidebar-link block p-4 text-gray-700">Settings</a></li>
                <li><a href="logout.php" class="sidebar-link block p-4 text-gray-700">Logout</a></li>
            </ul>
        </div>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Job Management</h1>

    <!-- Filters -->
    <form method="GET" class="mb-6 bg-white p-4 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select name="job_type" class="p-2 border rounded-lg">
                <option value="">All Job Types</option>
                <?php while ($type = $jobTypes->fetch_assoc()): ?>
                    <option value="<?php echo $type['job_type']; ?>" 
                        <?php echo isset($filters['job_type']) && $filters['job_type'] === $type['job_type'] ? 'selected' : ''; ?>>
                        <?php echo $type['job_type']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <select name="location" class="p-2 border rounded-lg">
                <option value="">All Locations</option>
                <?php while ($location = $locations->fetch_assoc()): ?>
                    <option value="<?php echo $location['location']; ?>" 
                        <?php echo isset($filters['location']) && $filters['location'] === $location['location'] ? 'selected' : ''; ?>>
                        <?php echo $location['location']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <select name="sort" class="p-2 border rounded-lg">
                <option value="newest" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'selected' : ''; ?>>Newest</option>
                <option value="oldest" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'selected' : ''; ?>>Oldest</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg">Apply Filters</button>
        </div>
    </form>

    <!-- Messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-<?php echo $_SESSION['message_type'] === 'success' ? 'green' : 'red'; ?>-500 text-white px-4 py-3 rounded-lg mb-6">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Jobs Table -->
    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">Job ID</th>
            <th class="py-3 px-6 text-left">Job Title</th>
            <th class="py-3 px-6 text-left">Category</th>
            <th class="py-3 px-6 text-center">Job Type</th>
            <th class="py-3 px-6 text-center">Job Post Date</th>
            <th class="py-3 px-6 text-center">Location</th>
            <th class="py-3 px-6 text-center">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left"><?php echo $row['job_id']; ?></td>
                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($row['job_title']); ?></td>
                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($row['category_id']); ?></td>
                <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['job_type']); ?></td>
                <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['job_post_date']); ?></td>
                <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['location']); ?></td>
                <td class="py-3 px-6 text-center">
                <a href="edit-job.php?id=<?php echo $row['job_id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                <a href="delete-job.php?id=<?php echo $row['job_id']; ?>" class="text-red-600 hover:underline ml-2"
                       onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
