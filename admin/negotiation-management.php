<?php
    include '../connect.php';
    include 'header.php';
    // Fetch logged-in admin name
    session_start();
    $admin_name = '';
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        $admin_query = "SELECT username FROM admins WHERE admin_id = '$admin_id'"; // Assuming there's an 'admins' table
        $admin_result = mysqli_query($conn, $admin_query);
        if ($admin_row = mysqli_fetch_assoc($admin_result)) {
            $admin_name = $admin_row['username'];
        }
    }

    // Fetch all job posts and their corresponding negotiation counts
    $query = "SELECT jobs.job_id, jobs.job_title, COUNT(negotiations.negotiation_id) AS negotiation_count
              FROM jobs
              LEFT JOIN negotiations ON jobs.job_id = negotiations.job_id
              GROUP BY jobs.job_id";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negotiation Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
            <ul class="mt-4">
                <li><a href="dashboard.php" class="sidebar-link block p-4 text-gray-700">Dashboard</a></li>
                <li><a href="user-management.php" class="sidebar-link block p-4 text-gray-700">User Management</a></li>
                <li><a href="job-management.php" class="sidebar-link block p-4 text-gray-700">Job Management</a></li>
                <li><a href="negotiation-management.php" class="sidebar-link block p-4 text-gray-700 bg-gray-200">Negotiation Management</a></li>
                <li><a href="logout.php" class="sidebar-link block p-4 text-gray-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header with Admin Name -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Negotiation Management</h1>
                <div class="relative">
                    <button class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-full">
                        <span class="mr-2"><?= htmlspecialchars($admin_name) ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15l9-9-9 9-9-9 9 9z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Negotiation Table -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Negotiations for Job Posts</h2>
                <div class="bg-white p-4 shadow rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">Job Title</th>
                                <th class="px-4 py-2 text-left">Negotiation Count</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['job_title']) ?></td>
                                    <td class="px-4 py-2"><?= $row['negotiation_count'] ?></td>
                                    <td class="px-4 py-2">
                                        <a href="view-negotiations.php?job_id=<?= $row['job_id'] ?>" class="text-blue-600 hover:text-blue-800">View Negotiations</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
