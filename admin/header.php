<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-gray-800 p-4 fixed top-0 left-0 w-full z-50">
        <div class="flex justify-between items-center">
            <!-- Logo or Brand Name -->
            <div class="text-white font-bold text-xl">
                Workese
            </div>

            <!-- Hamburger Menu (visible on small screens) -->
            <div class="lg:hidden flex items-center">
                <button id="hamburger" class="text-white" onclick="toggleNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Links (visible on large screens) -->
            <div class="hidden lg:flex space-x-6">
                <a href="admin-home.php" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md">Dashboard</a>
                <a href="user-management.php" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md">User Management</a>
                <a href="job-management.php" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md">Job Management</a>
                <a href="negotiation-management.php" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md">Negotiation Management</a>
                <a href="logout.php" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Sidebar Menu (Initially hidden) -->
    <div id="sidebar" class="lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-40 hidden">
        <div class="flex justify-end p-4">
            <button onclick="toggleNav()" class="text-white text-3xl">&times;</button>
        </div>
        <div class="flex flex-col items-center space-y-4">
            <a href="admin-home.php" class="text-white text-lg">Dashboard</a>
            <a href="user-management.php" class="text-white text-lg">User Management</a>
            <a href="job-management.php" class="text-white text-lg">Job Management</a>
            <a href="negotiation-management.php" class="text-white text-lg">Negotiation Management</a>
            <a href="reports.php" class="text-white text-lg">Reports</a>
            <a href="settings.php" class="text-white text-lg">Settings</a>
            <a href="logout.php" class="text-white text-lg">Logout</a>
        </div>
    </div>

    <script>
        // Function to toggle sidebar visibility
        function toggleNav() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>

</body>
</html>
