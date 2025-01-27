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

    // Check if ID is provided in URL
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // Fetch the user's current data
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
        } else {
            echo "User not found!";
            exit();
        }
    } else {
        echo "No user ID provided!";
        exit();
    }

    // Handle the form submission to update user details
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $district = $_POST['district'];
        $role = $_POST['role'];

        // SQL query to update user data
        $update_query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', district = '$district', role = '$role' WHERE id = '$user_id'";

        if (mysqli_query($conn, $update_query)) {
            // Redirect to the user management page after updating
            header('Location: user-management.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-4">Edit User</h2>
            <form method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user_data['name']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-semibold text-gray-700">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user_data['phone']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="district" class="block text-lg font-semibold text-gray-700">District</label>
                    <input type="text" id="district" name="district" value="<?= htmlspecialchars($user_data['district']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-lg font-semibold text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="recruiter" <?= $user_data['role'] == 'recruiter' ? 'selected' : ''; ?>>Recruiter</option>
                        <option value="worker" <?= $user_data['role'] == 'worker' ? 'selected' : ''; ?>>Worker</option>
                    </select>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Save Changes</button>
                    <a href="user-management.php" class="text-red-600 hover:text-red-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
