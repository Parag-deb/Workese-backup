<?php
session_start();
require '../connect.php';
include '../nav.php';

// Fetch user details (example based on session email)
if (isset($_SESSION['id'])) {
    $email = $_SESSION['id'];
    $query = "SELECT *
            FROM users 
            LEFT JOIN recruiters ON users.id = recruiters.user_id 
            WHERE users.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User  not found.";
        exit;
    }
} else {
    echo "User  not logged in.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Job Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded relative">
        <div class="flex items-center space-x-4">
            <img alt="Profile picture of user" class="w-16 h-16 rounded-full" src="https://via.placeholder.com/100" />
            <div>
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($user['name'] ?? ''); ?></h2>
                <p class="text-gray-500"><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
            </div>
            <div class="absolute top-4 right-4 flex space-x-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400" onclick="window.location.href='edit-profile.php'">Edit</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400" onclick="window.location.href='workers-under-me.php'">My Workers</button>

            </div>
        </div>
        <form class="mt-8 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Full Name</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Date of Birth</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['date_of_birth'] ?? ''); ?>" type="date" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" type="email" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Mobile Number</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" type="text" readonly />
 </div>
                <div>
                    <label class="block text-gray-700">Country</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="Bangladesh" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Division</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['division'] ?? ''); ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">District</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['district'] ?? ''); ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Upazila</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="upazila" value="<?php echo htmlspecialchars($user['upazila']); ?>" type="text" required />
                </div>
                <div>
                    <label class="block text-gray-700">Address</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" type="text" required />
                </div>
                <div>
                    <label class="block text-gray-700">Language</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['language'] ?? ''); ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Company Name</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['company_name'] ?? ''); ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Company Description</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['company_description'] ?? ''); ?>" type="text" readonly />
                </div>
            </div>
        </form>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>