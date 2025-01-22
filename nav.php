
<?php 

require 'connect.php'; // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header class="bg-black text-white p-4 flex justify-between items-center">
    <div class="md:hidden">
        <button id="menu-toggle" class="text-white focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="flex items-center">
        <i class="fas fa-briefcase mr-2"></i>
        <span class="text-xl font-bold">WORKEASE</span>
    </div>
    <nav class="hidden md:flex space-x-4">
        <?php 
        // Determine the home link based on user role
        if (isset($_SESSION['role'])): 
            if ($_SESSION['role'] === 'worker'): ?>
                <a class="hover:text-gray-400" href="home-worker.php">Home</a>
            <?php elseif ($_SESSION['role'] === 'recruiter'): ?>
                <a class="hover:text-gray-400" href="home-recruiter.php">Home</a>
            <?php endif; 
        else: ?>
            <a class="hover:text-gray-400" href="index.php">Home</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['role'])): ?>
            <?php if ($_SESSION['role'] === 'worker'): ?>
                <a class="hover:text-gray-400" href="jobs.php">Jobs</a>
            <?php elseif ($_SESSION['role'] === 'recruiter'): ?>
                <a class="hover:text-gray-400" href="worker-list.php">Workers</a>
            <?php endif; ?>
        <?php endif; ?>
        <a class="hover:text-gray-400" href="../about-us.php">About Us</a>
        <a class="hover:text-gray-400" href="../contact-us.php">Contact Us</a>
    </nav>
    <div class="flex items-center space-x-4">
        <?php if (isset($_SESSION['name'])) { ?>
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
            <button class="relative" onclick="toggleNotificationModal()">
                <i class="fas fa-bell text-white"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                    <?php
                    $notifications_count = 0;
                    if (isset($_SESSION['id'])) {
                        $userId = intval($_SESSION['id']);
                        $sql = "SELECT COUNT(*) FROM notifications WHERE worker_id = ? AND is_read = FALSE";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $userId);
                            $stmt->execute();
                            $stmt->bind_result($notifications_count);
                            $stmt->fetch();
                            $stmt->close();
                        }
                    }
                    echo htmlspecialchars($notifications_count);
                    ?>
                </span>
            </button>
            <form method="POST" action="logout.php" class="inline">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Log Out</button>
            </form>
        <?php } else { ?>
            <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Log In</a>
            <a href="create-account.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</a>
        <?php } ?>
    </div>
</header>
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg w-96 p-6 shadow-lg">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-semibold">Notifications</h2>
            <button onclick="toggleNotificationModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="notificationContainer" class="space-y-4">
            <!-- Notifications will be dynamically loaded here -->
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="toggleNotificationModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Close</button>
        </div>
    </div>
</div>
<script>
function toggleNotificationModal() {
    const modal = document.getElementById('notificationModal');
    modal.classList.toggle('hidden');
    if (!modal.classList.contains('hidden')) {
        fetchNotifications();
    }
}

function fetchNotifications() {
    const userId = <?php echo json_encode($_SESSION['id'] ?? null); ?>;
    fetch('fetch-notification.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}`,
    })
        .then((response) => response.text())
        .then((html) => {
            document.getElementById('notificationContainer').innerHTML = html;
        })
        .catch((error) => {
            console.error('Error fetching notifications:', error);
        });
}
</script>
</body>
</html>