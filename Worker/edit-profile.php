<?php
session_start();
require '../connect.php';
include '../nav.php';

// Check if user is logged in or ID is provided
if (isset($_SESSION['id']) || isset($_GET['id'])) {
    $userId = isset($_SESSION['id']) ? intval($_SESSION['id']) : intval($_GET['id']);

    // Fetch user data
    $sql = "SELECT users.*, workers.language_preferences AS language, workers.skills 
            FROM users 
            LEFT JOIN workers ON users.id = workers.user_id 
            WHERE users.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Fetch user data as associative array
    } else {
        die("User not found.");
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user ID is set
    if (isset($_POST['id'])) {
        $userId = intval($_POST['id']); // Sanitize user ID

        // Collect and sanitize input data
        $name = $conn->real_escape_string($_POST['name']);
        $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $division = $conn->real_escape_string($_POST['division']);
        $district = $conn->real_escape_string($_POST['district']);
        $upazila = $conn->real_escape_string($_POST['upazila']);
        $address = $conn->real_escape_string($_POST['address']);
        $language = $conn->real_escape_string($_POST['language']); // Language field
        $skills = $conn->real_escape_string($_POST['skills']); // Skills field

        // Update user information in the database
        $sql = "UPDATE users SET name=?, date_of_birth=?, phone=?, division=?, district=?, upazila=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $name, $date_of_birth, $phone, $division, $district, $upazila, $address, $userId);

        if ($stmt->execute()) {
            // Update language and skills in the workers table
            $workerSql = "UPDATE workers SET language_preferences=?, skills=? WHERE user_id=?";
            $workerStmt = $conn->prepare($workerSql);
            $workerStmt->bind_param("ssi", $language, $skills, $userId);

            if ($workerStmt->execute()) {
                echo "<script>
                    alert('Profile updated successfully!');
                    window.location.href = 'worker-profile.php';
                </script>";
            } else {
                echo "Error updating workers table: " . $conn->error;
            }
            $workerStmt->close();
        } else {
            echo "Error updating users table: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "User ID not provided.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded">
        <h2 class="text-2xl font-bold mb-4">Edit Your Profile</h2>
        <form action="edit-profile.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>" /> <!-- Hidden field for user ID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Full Name</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" type="text" required />
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" type="email" required readonly />
                </div>
                <div>
                    <label class="block text-gray-700">Date of Birth</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" type="date" required />
                </div>
                <div>
                    <label class="block text-gray-700">Mobile Number</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" type="text" required />
                </div>
                <div>
                    <label class="block text-gray-700">Division</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="division" value="<?php echo htmlspecialchars($user['division']); ?>" type="text" required />
                </div>
                <div>
                    <label class="block text-gray-700">District</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="district" value="<?php echo htmlspecialchars($user['district']); ?>" type="text" required />
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
                    <label class="block text-gray-700">Language Preferences</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="language" value="<?php echo htmlspecialchars($user['language'] ?? ''); ?>" type="text" placeholder="Comma-separated list of languages" />
                </div>
                <div>
                    <label class="block text-gray-700">Skills</label>
                    <input class="w-full p-2 border border-gray-300 rounded" name="skills" value="<?php echo htmlspecialchars($user['skills'] ?? ''); ?>" type="text" placeholder="Comma-separated list of skills" />
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600" type="submit">Update Profile</button>
            </div>
        </form>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
