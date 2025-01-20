<?php
session_start();
require '../connect.php';
include '../nav.php';

// Fetch user details (example based on session email)
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User not logged in.";
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
                <h2 class="text-xl font-bold"><?php echo $user['name']; ?></h2>
                <p class="text-gray-500"><?php echo $user['email']; ?></p>
            </div>
            <div class="absolute top-4 right-4 flex space-x-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400">Post a Job</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400">Edit</button>
            </div>
        </div>
        <form class="mt-8 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Full Name</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['name']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Date of Birth</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['date_of_birth']; ?>" type="date" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['email']; ?>" type="email" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Mobile Number</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['phone']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Country</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="Bangladesh" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Division</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['division']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">District</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['district']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Language</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['language']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Experience</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['experience']; ?>" type="text" readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Salary</label>
                    <input class="w-full p-2 border border-gray-300 rounded" value="<?php echo $user['salary']; ?>" type="text" readonly />
                </div>
            </div>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
