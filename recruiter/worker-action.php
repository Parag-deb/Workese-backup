<?php
require '../connect.php';
session_start();

if ($_POST['action'] == 'fetchData') {
    $workerName = isset($_POST['worker_name']) ? $_POST['worker_name'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $categories = isset($_POST['categories']) ? implode(",'", $_POST['categories']) : '';
    $jobTypes = isset($_POST['job_types']) ? implode(",'", $_POST['job_types']) : '';
    $experiences = isset($_POST['experiences']) ? implode(",'", $_POST['experiences']) : '';
    $minRating = isset($_POST['min_rating']) ? (float)$_POST['min_rating'] : 0; // Minimum rating filter

    // Build the SQL query based on filters
    $sql = "SELECT workers.*, users.name, users.district, AVG(rating.rating_value) AS avg_rating 
            FROM workers 
            JOIN users ON workers.user_id = users.id
            LEFT JOIN rating ON users.id = rating.user_id
            WHERE 1=1 "; // Start with a base query




    if (!empty($workerName)) {
        $sql .= " AND users.name LIKE '%" . $conn->real_escape_string($workerName) . "%'";
    }
    if (!empty($location)) {
        $sql .= " AND users.district = '" . $conn->real_escape_string($location) . "'";
    }
 
    if (!empty($experiences)) {
        $experienceList = "'" . implode("','", array_map([$conn, 'real_escape_string'], $_POST['experiences'])) . "'";
        $sql .= " AND workers.experience IN ($experienceList)";
    }
    if ($minRating > 0) {
        $sql .= " HAVING avg_rating >= $minRating"; // Filter by average rating
    }

    $sql .= " GROUP BY workers.worker_id"; // Group by worker to calculate average rating

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($worker = $result->fetch_assoc()) {
            // Output worker details as needed
            echo "<div class='worker-card bg-white p-4 rounded shadow-md'>";
            echo "<h3 class='font-bold'>" . htmlspecialchars($worker['name']) . "</h3>";
            echo "<p>Location: " . htmlspecialchars($worker['district']) . "</p>";
            // echo "<p>Category: " . htmlspecialchars($worker['category']) . "</p>";
            // echo "<p>Job Type: " . htmlspecialchars($worker['job_type']) . "</p>";
            echo "<p>Experience: " . htmlspecialchars($worker['experience']) . "</p>";
            echo "<p>Average Rating: " . htmlspecialchars(round($worker['avg_rating'], 2)) . "</p>";
            echo "</div>";
        }
    } else {
        echo "No workers found.";
    }
}

$conn->close();
?>
