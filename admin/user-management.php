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

    // Default filters for role and district
    $role_filter = '';
    $district_filter = '';

    if (isset($_GET['role']) && !empty($_GET['role'])) {
        $role_filter = $_GET['role'];
    }

    if (isset($_GET['district']) && !empty($_GET['district'])) {
        $district_filter = $_GET['district'];
    }

    // Fetch users based on role and district filters
    $query = "SELECT * FROM users WHERE 1"; // Default query to get all users
    if ($role_filter) {
        $query .= " AND role = '$role_filter'";
    }
    if ($district_filter) {
        $query .= " AND district = '$district_filter'";
    }
    $result = mysqli_query($conn, $query);

    // Fetch distinct districts for filtering
    $district_query = "SELECT DISTINCT district FROM users";
    $district_result = mysqli_query($conn, $district_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Dashboard</title>
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
                <li><a href="admin-home.php" class="sidebar-link block p-4 text-gray-700">Dashboard</a></li>
                <li><a href="user-management.php" class="sidebar-link block p-4 text-gray-700 bg-gray-200">User Management</a></li>
                <li><a href="job-management.php" class="sidebar-link block p-4 text-gray-700">Job Management</a></li>
                <li><a href="negotiation-management.php" class="sidebar-link block p-4 text-gray-700">Negotiation Management</a></li>
                <li><a href="reports.php" class="sidebar-link block p-4 text-gray-700">Reports</a></li>
                <li><a href="settings.php" class="sidebar-link block p-4 text-gray-700">Settings</a></li>
                <li><a href="logout.php" class="sidebar-link block p-4 text-gray-700">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header with Admin Name -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
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
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</a>
                    </div>
                </div>
            </div>

            <!-- Filters (Role and District) Side by Side -->
            <div class="mb-4 flex space-x-4">
                <!-- Role Filter Dropdown -->
                <div class="flex items-center">
                    <label for="roleFilter" class="text-lg font-semibold text-gray-700">Filter by Role:</label>
                    <select id="roleFilter" class="ml-2 bg-white border border-gray-300 rounded-lg p-2" onchange="window.location.href='user-management.php?role=' + this.value + '&district=<?= urlencode($district_filter) ?>'">
                        <option value="">All Roles</option>
                        <option value="recruiter" <?= $role_filter == 'recruiter' ? 'selected' : ''; ?>>Recruiter</option>
                        <option value="worker" <?= $role_filter == 'worker' ? 'selected' : ''; ?>>Worker</option>
                    </select>
                </div>

                <!-- District Filter Dropdown -->
                <div class="flex items-center">
                    <label for="districtFilter" class="text-lg font-semibold text-gray-700">Filter by District:</label>
                    <select id="districtFilter" class="ml-2 bg-white border border-gray-300 rounded-lg p-2" onchange="window.location.href='user-management.php?district=' + this.value + '&role=<?= urlencode($role_filter) ?>'">
                        <option value="">All Districts</option>
                        <?php while ($district_row = mysqli_fetch_assoc($district_result)): ?>
                            <option value="<?= $district_row['district'] ?>" <?= $district_filter == $district_row['district'] ? 'selected' : ''; ?>><?= htmlspecialchars($district_row['district']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <!-- User Table -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Manage Users</h2>
                <div class="bg-white p-4 shadow rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Phone</th>
                                <th class="px-4 py-2 text-left">District</th>
                                <th class="px-4 py-2 text-left">Role</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-2"><?= $row['id'] ?></td>
                                    <td class="px-4 py-2"><?= $row['name'] ?></td>
                                    <td class="px-4 py-2"><?= $row['email'] ?></td>
                                    <td class="px-4 py-2"><?= $row['phone'] ?></td>
                                    <td class="px-4 py-2"><?= $row['district'] ?></td>
                                    <td class="px-4 py-2"><?= $row['role'] ?></td>
                                    <td class="px-4 py-2">
                                        <a href="edit-user.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        <a href="delete-user.php?id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-800 ml-4">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add User Button
            <div class="mt-8">
                <a href="add-user.php" class="bg-green-600 text-white px-4 py-2 rounded-md">Add New User</a>
            </div> -->
        </div>
    </div>
</body>
</html>
