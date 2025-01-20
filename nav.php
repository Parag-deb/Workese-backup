<?php 
require 'connect.php';
// session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script>
    // Toggle the notification modal
    function toggleNotificationModal() {
      const modal = document.getElementById('notificationModal');
      modal.classList.toggle('hidden');
    }
  </script>
</head>
<body>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <!-- Logo Section -->
    <div class="flex items-center">
        <i class="fas fa-briefcase mr-2"></i>
        <span class="text-xl font-bold">WORKEASE</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="hidden md:flex space-x-4">
        <a class="hover:text-gray-400" href="/home/index.html">Home</a>
        <a class="hover:text-gray-400" href="jobs.php">Jobs</a>
        <a class="hover:text-gray-400" href="../about-us.php">About Us</a>
        <a class="hover:text-gray-400" href="../contact-us.php">Contact Us</a>
    </nav>

    <!-- User Profile and Authentication -->
    <div class="flex items-center space-x-4">
        <?php if (isset($_SESSION['name'])) { ?>
            <!-- Logged-in User Section -->
            <a href="worker-profile.php" class="text-blue-500 hover:underline" title="Go to profile">
                <?php echo htmlspecialchars($_SESSION['name']); ?>
            </a>
            <img 
                alt="User Avatar" 
                class="rounded-full" 
                height="40" 
                src="https://storage.googleapis.com/a1aa/image/lyou4ghwI2rfFSOMEefw0VROzQIkdIGqehYskzfb92Fn3lSgC.jpg" 
                width="40"
            />
            <!-- Notification Button -->
            <button class="relative" onclick="toggleNotificationModal()">
                <i class="fas fa-bell text-white"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                    <?php echo $notifications_count ?? '0'; ?>
                </span>
            </button>
            <form method="POST" action="logout.php" class="inline">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Log Out</button>
            </form>
        <?php } else { ?>
            <!-- Guest User Section -->
            <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Log In</a>
            <a href="create-account.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</a>
        <?php } ?>
    </div>
</header>

<!-- Notification Modal -->
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg w-96 p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Notifications</h2>
            <button onclick="toggleNotificationModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-2">
            <?php 
            // Sample notifications array (replace with your database query)
            $notifications = [
                "You have a new job offer.",
                "Your profile has been viewed 5 times today.",
                "Reminder: Update your availability."
            ];
            if (!empty($notifications)) {
                foreach ($notifications as $notification) {
                    echo '<div class="p-2 border rounded hover:bg-gray-100">' . htmlspecialchars($notification) . '</div>';
                }
            } else {
                echo '<div class="text-gray-500">No new notifications.</div>';
            }
            ?>
        </div>
        <div class="mt-4">
            <button onclick="toggleNotificationModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>
</div>
</body>
</html>
