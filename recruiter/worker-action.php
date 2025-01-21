<?php
require '../connect.php';
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'fetchData') {
    $jobTitle = isset($_POST['job_title']) ? $conn->real_escape_string($_POST['job_title']) : '';
    $location = isset($_POST['location']) ? $conn->real_escape_string($_POST['location']) : '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
    $jobTypes = isset($_POST['job_types']) ? $_POST['job_types'] : [];
    $experiences = isset($_POST['experiences']) ? $_POST['experiences'] : [];

    // Build the SQL query based on filters
    $sql = "SELECT * FROM workers 
                        JOIN
                        users
                        ON
                        workers.user_id = users.id
                        WHERE 1=1 ";             // Start with a base query

    if (!empty($jobTitle)) {
        $sql .= " AND job_title LIKE '%$jobTitle%'"; // Filter by job title
    }
    if (!empty($location)) {
        $sql .= " AND users.district = '$location'"; // Filter by location
    }
    if (!empty($categories)) {
        $categoryList = "'" . implode("','", array_map($conn->real_escape_string, $categories)) . "'";
        $sql .= " AND category IN ($categoryList)"; // Filter by categories
    }
    if (!empty($jobTypes)) {
        $jobTypeList = "'" . implode("','", array_map($conn->real_escape_string, $jobTypes)) . "'";
        $sql .= " AND job_type IN ($jobTypeList)"; // Filter by job types
    }
    if (!empty($experiences)) {
        $experienceList = "'" . implode("','", array_map($conn->real_escape_string, $experiences)) . "'";
        $sql .= " AND experience IN ($experienceList)"; // Filter by experience levels
    }

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($worker = $result->fetch_assoc()) {
            // Output worker details as needed
            echo "<div class='worker-card bg-white p-4 rounded shadow-md'>";
            echo "<h3 class='font-bold'>" . htmlspecialchars($worker['name']) . "</h3>";
            //echo "<p>Location: " . htmlspecialchars($worker['location']) . "</p>";
            //echo "<p>Job Title: " . htmlspecialchars($worker['job_title']) . "</p>";
            //echo "<p>Category: " . htmlspecialchars($worker['category']) . "</p>";
            //echo "<p>Job Type: " . htmlspecialchars($worker['job_type']) . "</p>";
            echo "<p>Experience: " . htmlspecialchars($worker['experience']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "No workers found.";
    }
}
$conn->close();
?>