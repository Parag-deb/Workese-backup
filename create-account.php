<?php 
include 'connect.php';
include 'nav.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    $required_fields = ['name', 'email', 'date_of_birth', 'phone', 'gender', 'password', 'description', 'division', 'district', 'upazila', 'address', 'education_title', 'education_degree', 'education_institute', 'education_year'];

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            die("Error: Missing required field: $field");
        }
    }

    // Collect and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $description = $conn->real_escape_string($_POST['description']);
    $division = $conn->real_escape_string($_POST['division']);
    $district = $conn->real_escape_string($_POST['district']);
    $upazila = $conn->real_escape_string($_POST['upazila']);
    $address = $conn->real_escape_string($_POST['address']);
    $education_title = $conn->real_escape_string($_POST['education_title']);
    $education_degree = $conn->real_escape_string($_POST['education_degree']);
    $education_institute = $conn->real_escape_string($_POST['education_institute']); 
    $education_year = $conn->real_escape_string($_POST['education_year']);
    $facebook = isset($_POST['facebook']) ? $conn->real_escape_string($_POST['facebook']) : '';
    $instagram = isset($_POST['instagram']) ? $conn->real_escape_string($_POST['instagram']) : '';
    $linkedin = isset($_POST['linkedin']) ? $conn->real_escape_string($_POST['linkedin']) : '';
    $whatsapp_number = isset($_POST['whatsapp_number']) ? $conn->real_escape_string($_POST['whatsapp_number']) : '';
    $expertise_title = isset($_POST['expertise_title']) ? $conn->real_escape_string($_POST['expertise_title']) : '';
    $expertise_level = isset($_POST['expertise_level']) ? $conn->real_escape_string($_POST['expertise_level']) : '';

    // $emai_sql= "SELECT * FROM users WHERE email = '$email'";
    // $result = mysqli_query($conn , $emai_sql);
    // $rowCount = mysqli_num_rows($result);
    // if ($rowCount > 0){
    //     echo "<script>alert('Registration successful!');
    // }


    // Insert data into the users table
    $sql = "INSERT INTO users (name, email, date_of_birth, phone, gender, password, description, division, district, upazila, address, education_title, education_degree, education_institute, education_year, facebook, instagram, linkedin, whatsapp_number, expertise_title, expertise_level) 
            VALUES ('$name', '$email', '$date_of_birth', '$phone', '$gender', '$password', '$description', '$division', '$district', '$upazila', '$address', '$education_title', '$education_degree', '$education_institute', '$education_year', '$facebook', '$instagram', '$linkedin', '$whatsapp_number', '$expertise_title', '$expertise_level')";

if ($conn->query($sql) === TRUE) {
    // Registration successful, redirect to login page with a success message
    echo "<script>alert('Registration successful!'); 
    //window.location.href='create-account.php';</script>";
    exit();
} else {
    // Registration failed
    $error = "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the connection
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Create Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https:// cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body class="font-roboto">
<!-- <header class="bg-black text-white">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="flex items-center">
            <img alt="Logo" class="mr-2" height="30" src="https://storage.googleapis.com/a1aa/image/E7INiQyIjO4fSicCYTqEpeAs0KSSXxpD0JWRytVGIjzegqEoA.jpg" width="30"/>
            <span class="font-bold">WORKESE</span>
        </div>
        <nav class="hidden md:flex space-x-4">
            <div class="hidden md:flex space-x-4">
                <a class="hover:text-gray-400" href="/home/index.html">Home</a>
                <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
                <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
                <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
            </div>
        </nav>
        <div class="space-x-4">
            <button class="bg-transparent border border-white py-1 px-4 rounded hover:bg-white hover:text-black">Login</button>
            <button class="bg-green-500 py-1 px-4 rounded hover:bg-green-600">Register</button>
        </div>
    </div>
</header> -->

<main class="bg-cover bg-center" style="background-image: url('https://placehold.co/1920x400');">
    <div class="container mx-auto text-center py-20 px-4">
        <h1 class="text-4xl font-bold text-white">Create Your Account</h1>
        <p class="text-xl text-white mt-4">Already create an account?</p>
        <button class="mt-4 bg-green-500 text-white py-2 px-6 rounded hover:bg-green-600">Sign In</button>
    </div>
</main>
<section class="container mx-auto py-10 px-4 md:px-6">
    <form action="create-account.php" method="POST"> <!-- Ensure the action points to the correct PHP script -->
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Basic Information</h2>
            <div class="border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input class="border p-2 w-full" name="name" placeholder="Your name:" type="text" required/>
                    <input class="border p-2 w-full" name="email" placeholder="Your email:" type="email" required/>
                    <input class="border p-2 w-full" name="date_of_birth" placeholder="Date of birth:" type="date" required/>
                    <input class="border p-2 w-full" name="phone" placeholder="Your phone:" type="text" required/>
                    <input class="border p-2 w-full" name="gender" placeholder="Gender:" type="text" required/>
                    <input class="border p-2 w-full" name="password" placeholder="Password:" type="password" required/>
                    <input class="border p-2 w-full" name="confirm_password" placeholder="Confirm Password:" type="password" required/>
                    <textarea class="border p-2 w-full h-24 md:col-span-2" name="description" placeholder="Description:" required></textarea>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Locations</h2>
            <div class="border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input class="border p-2 w-full" name="division" placeholder="Division:" type="text" required/>
                    <input class="border p-2 w-full" name="district" placeholder="District:" type="text" required/>
                    <input class="border p-2 w-full" name="upazila" placeholder="Upazila:" type="text" required/>
                    <input class="border p-2 w-full" name=" address" placeholder="Address:" type="text" required/>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Education</h2>
            <div class="border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input class="border p-2 w-full" name="education_title" placeholder="Title:" type="text" required/>
                    <input class="border p-2 w-full" name="education_degree" placeholder="Degree:" type="text" required/>
                    <input class="border p-2 w-full" name="education_institute" placeholder="Institute:" type="text" required/>
                    <input class="border p-2 w-full" name="education_year" placeholder="Year:" type="text" required/>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Social Links</h2>
            <div class="border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input class="border p-2 w-full" name="facebook" placeholder="Facebook:" type="text"/>
                    <input class="border p-2 w-full" name="instagram" placeholder="Instagram:" type="text"/>
                    <input class="border p-2 w-full" name="linkedin" placeholder="LinkedIn:" type="text"/>
                    <input class="border p-2 w-full" name="whatsapp_number" placeholder="WhatsApp Number:" type="text"/>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Expertise</h2>
            <div class="border p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input class="border p-2 w-full" name="expertise_title" placeholder="Expertise Title:" type="text" required/>
                    <input class="border p-2 w-full" name="expertise_level" placeholder="Expertise Level:" type="text" required/>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="bg-green-500 text-white py-2 px-6 rounded hover:bg-green-600" type="submit">Register</button>
        </div>
    </form>
</section>
<footer class="bg-black text-white mt-8 p-4">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <h3 class="font-bold">Job</h3>
            <p>Get more information about various job opportunities. Connect with employers and find your dream job.</p>
        </div>
        <div>
            <h3 class="font-bold">Company</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="#">About Us</a></li>
                <li><a class="hover:text-gray-400" href="#">Contact Us</a></li>
                <li><a class="hover:text-gray-400" href="#">Careers</a></li>
                <li><a class="hover:text-gray-400" href="#">For Employers</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold">Job Categories</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="#">Technology</a></li>
                <li><a class="hover:text-gray-400" href="#">Finance</a></li>
                <li><a class="hover:text-gray-400" href="#">Healthcare</a></li>
                <li><a class="hover:text-gray-400" href="#">Education</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold">Newsletter</h3>
            <p>Subscribe to our newsletter to get the latest job updates.</p>
            <input class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Enter your email" type="email"/>
            <button class="w-full bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-400">Subscribe Now</button>
        </div>
    </div>
    <div class="text-center mt-4">
        <p>© 2023 Job Portal. All rights reserved .</p>
        <div class="space-x-4">
            <a class="hover:text-gray-400" href="#">Privacy Policy</a>
            <a class="hover:text-gray-400" href="#">Terms & Conditions</a>
        </div>
    </div>
</footer>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });
</script>
</body>
</html>