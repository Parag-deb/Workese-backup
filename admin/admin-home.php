<?php
    include '../connect.php';
    session_start();

    // Fetch logged-in admin name
    $admin_name = '';
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        $admin_query = "SELECT username FROM admins WHERE admin_id = '$admin_id'"; // Assuming there's an 'admins' table
        $admin_result = mysqli_query($conn, $admin_query);
        if ($admin_row = mysqli_fetch_assoc($admin_result)) {
            $admin_name = $admin_row['username'];
        }
    }

    // Fetch the total number of users
    $user_count_query = "SELECT COUNT(*) AS total_users FROM users";
    $user_count_result = mysqli_query($conn, $user_count_query);
    $user_count_row = mysqli_fetch_assoc($user_count_result);
    $total_users = $user_count_row['total_users'];

    // Fetch the total number of jobs
    $job_count_query = "SELECT COUNT(*) AS total_jobs FROM jobs"; // Assuming there’s a 'jobs' table
    $job_count_result = mysqli_query($conn, $job_count_query);
    $job_count_row = mysqli_fetch_assoc($job_count_result);
    $total_jobs = $job_count_row['total_jobs'];

    // Fetch the number of users registered today
    $today = date('Y-m-d'); // Get the current date
    $users_today_query = "SELECT name, created_at, role FROM users WHERE DATE(created_at) = '$today' LIMIT 6"; // Fetch 6 users who joined today
    $users_today_result = mysqli_query($conn, $users_today_query);
    
    // Fetch the most recent jobs posted today
    $jobs_today_query = "SELECT jobs.job_title, jobs.created_at, users.name AS posted_by FROM jobs
                         JOIN users ON jobs.user_id = users.id
                         WHERE DATE(jobs.created_at) = '$today' LIMIT 6"; // Fetch 6 jobs posted today
    $jobs_today_result = mysqli_query($conn, $jobs_today_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Custom styles for hover effects and transitions */
        .sidebar-link:hover {
            background-color: #edf2f7; /* Light gray */
            transition: background-color 0.3s ease;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
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
                <li><a href="negotiation-management.php" class="sidebar-link block p-4 text-gray-700">Negotiation Management</a></li>
                <li><a href="logout.php" class="sidebar-link block p-4 text-gray-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header with Admin Name -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <div class="relative">
                    <button class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-full">
                        <span class="mr-2"><?= htmlspecialchars($admin_name) ?></span> <!-- Display logged-in admin's name -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15l9-9-9 9-9-9 9 9z"></path>
                        </svg>
                    </button>
                    <!-- Dropdown (optional) -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Settings</a>
                        <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</a>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                <div class="card bg-white p-6 shadow rounded-lg">
                    <h2 class="font-semibold text-lg text-gray-700">Total Users</h2>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_users ?></p> <!-- Display total users -->
                </div>
                <div class="card bg-white p-6 shadow rounded-lg">
                    <h2 class="font-semibold text-lg text-gray-700">Total Jobs</h2>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_jobs ?></p> <!-- Display total jobs -->
                </div>
                <div class="card bg-white p-6 shadow rounded-lg">
                    <h2 class="font-semibold text-lg text-gray-700">Users Registered Today</h2>
                    <p class="text-3xl font-bold text-blue-600"><?= mysqli_num_rows($users_today_result) ?></p> <!-- Display users registered today -->
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800">Recent Activity</h2>
                <div class="bg-white p-4 shadow rounded-lg mt-4">
                    <h3 class="text-lg font-semibold text-gray-700">Jobs Posted Today</h3>
                    <ul class="list-disc list-inside mt-4">
                        <?php
                            if (mysqli_num_rows($jobs_today_result) > 0) {
                                while ($job = mysqli_fetch_assoc($jobs_today_result)) {
                                    echo "<li>Job '{$job['job_title']}' posted by {$job['posted_by']}.</li>";
                                }
                            } else {
                                echo "<li>No jobs posted today.</li>";
                            }
                        ?>
                    </ul>
                    <h3 class="text-lg font-semibold text-gray-700 mt-6">Users Registered Today</h3>
                    <ul class="list-disc list-inside mt-4">
                        <?php
                            if (mysqli_num_rows($users_today_result) > 0) {
                                while ($user = mysqli_fetch_assoc($users_today_result)) {
                                    echo "<li>User {$user['name']} joined as {$user['role']}.</li>";
                                }
                            } else {
                                echo "<li>No users registered today.</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
