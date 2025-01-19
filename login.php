<?php
session_start();
require 'connect.php';
// Start session


// Database configuration


// Process the login form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and Password are required!'); window.location.href = 'login.html';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href = 'login.html';</script>";
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result , MYSQLI_ASSOC);
    if($user){
        if(password_verify($password, $user["password"])){
            $_SESSION['id']= $user['id'];
            $_SESSION['email']=$user['email'];
            $_SESSION['name']=$user['name'];
            header("Location:post-a-job.php");
            die();
        }
        else {
                    echo "<script>alert('Incorrect password!');</script>";
                }
    }

    // Prepare and execute the query
    // $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = '$email'");
    // $stmt->bind_param("s", $email);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($result->num_rows === 1) {
    //     // Fetch user details
    //     $user = $result->fetch_assoc();
    //     // Verify password
    //     if (password_verify($password, $user['password'])) {
    //         // Set session variables
    //         $_SESSION['user_id'] = $user['id'];
    //         $_SESSION['user_name'] = $user['name'];
    //         $_SESSION['user_email'] = $user['email'];
    //         $_SESSION['user_role'] = $user['role'];

    //         // Redirect based on role
    //         if ($user['role'] === 'worker') {
    //             header("Location: /worker/dashboard.php");
    //         } elseif ($user['role'] === 'employer') {
    //             header("Location: /employer/dashboard.php");
    //         } else {
    //             header("Location: /admin/dashboard.php");
    //         }
    //         exit();
    //     } else {
    //         echo "<script>alert('Incorrect password!'); window.location.href = 'index.html';</script>";
    //     }
    // } else {
    //     echo "<script>alert('No account found with this email!'); window.location.href = 'index.html';</script>";
    // }
    // $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <nav class="bg-black text-white p-4 flex justify-between items-center">
    <div class="flex items-center">
      <i class="fas fa-briefcase mr-2"></i>
      <span class="font-bold">WORKESE</span>
    </div>
    <div class="hidden md:flex space-x-4">
      <a class="hover:text-gray-400" href="/home/index.html">Home</a>
      <a class="hover:text-gray-400" href="/jobs/index.html">Jobs</a>
      <a class="hover:text-gray-400" href="/about us/index.html">About Us</a>
      <a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a>
    </div>
    <div class="flex space-x-4">
      <a class="hover:text-gray-400" href="/log in/index.html">Login</a>
      <a class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" href="/create account/index.html">Register</a>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="flex flex-col items-center justify-center min-h-screen p-4">
    <h1 class="text-4xl font-bold text-black mt-8 text-center">Login Into Your Account!</h1>
    <div class="bg-teal-500 p-8 rounded-lg mt-8 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
      <div class="bg-white p-8 rounded-lg text-center">
        <h2 class="font-bold">Worker Login</h2>
        <button class="bg-teal-500 text-white px-4 py-2 mt-4 rounded">Get Started</button>
      </div>
      <div class="bg-white p-8 rounded-lg text-center">
        <h2 class="font-bold">Employer Login</h2>
        <button class="bg-teal-500 text-white px-4 py-2 mt-4 rounded">Get Started</button>
      </div>
    </div>
    <div class="bg-white p-8 rounded-lg mt-8 w-full max-w-md">
      <form method="POST" action="login.php">
        <div class="flex items-center border-b border-gray-300 py-2">
          <i class="fas fa-user mr-2"></i>
          <input name="email" aria-label="Username" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="Email" type="text" required>
        </div>
        <div class="flex items-center border-b border-gray-300 py-2 mt-4">
          <i class="fas fa-lock mr-2"></i>
          <input name="password" aria-label="Password" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="Password" type="password" required>
        </div>
        <div class="text-center mt-4">
          <a class="text-gray-500" href="#">Forgot Password?</a>
        </div>
        <div class="text-center mt-2">
          <span class="text-gray-500">Don't Have Account?</span>
          <a class="text-blue-500" href="/create account/index.html">Sign Up Here</a>
        </div>
        <button type="submit" class="bg-green-500 text-white w-full py-2 mt-4 rounded">Sign In</button>
      </form>
      <button class="bg-white border border-gray-300 text-gray-700 w-full py-2 mt-4 rounded flex items-center justify-center">
        <img alt="Google logo" class="mr-2" height="20" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" width="20">
        Login with Google
      </button>
      <button class="bg-white border border-gray-300 text-gray-700 w-full py-2 mt-4 rounded flex items-center justify-center">
        <img alt="Facebook logo" class="mr-2" height="20" src="https://storage.googleapis.com/a1aa/image/Li7yHePj74S3GqBjIlujIwc8KTua2jutcsQketfl8FYX3GEoA.jpg" width="20">
        Login with Facebook
      </button>
    </div>
  </div>

  <!-- Footer -->
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
        <input class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Enter your email" type="email">
        <button class="w-full bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-400">Subscribe Now</button>
      </div>
    </div>
    <div class="text-center mt-4">
      <p>© 2023 Job Portal. All rights reserved.</p>
      <div class="space-x-4">
        <a class="hover:text-gray-400" href="#">Privacy Policy</a>
        <a class="hover:text-gray-400" href="#">Terms &amp; Conditions</a>
      </div>
    </div>
  </footer>
</body>
</html>
