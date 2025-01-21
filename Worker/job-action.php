<?php
require '../connect.php';

if (isset($_POST['action'])) {
    $output = '';
    
    if ($_POST['action'] == 'fetchData') {
        $jobid = isset($_POST['job_id']) ? $conn->real_escape_string($_POST['job_id']) : '';
        $jobTitle = isset($_POST['job_title']) ? $conn->real_escape_string($_POST['job_title']) : '';
        $location = isset($_POST['location']) ? $conn->real_escape_string($_POST['location']) : '';
        $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
        $jobTypes = isset($_POST['job_types']) ? $_POST['job_types'] : [];
        $sortBy = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'latest';

        // Build the SQL query based on filters
        $sql = "SELECT * FROM jobs WHERE 1=1"; // Start with a base query

        if (!empty($jobTitle)) {
            $sql .= " AND job_title LIKE '%$jobTitle%'"; // Filter by job title
        }
        if (!empty($location)) {
            $sql .= " AND location = '$location'"; // Filter by location
        }
        if (!empty($categories)) {
            $categoryList = "'" . implode("','", array_map($conn->real_escape_string, $categories)) . "'";
            $sql .= " AND category IN ($categoryList)"; // Filter by categories
        }
        if (!empty($jobTypes)) {
            $jobTypeList = "'" . implode("','", array_map($conn->real_escape_string, $jobTypes)) . "'";
            $sql .= " AND job_type IN ($jobTypeList)"; // Filter by job types
        }

        // Add sorting
        if ($sortBy == 'latest') {
            $sql .= " ORDER BY created_at DESC"; // Assuming you have a created_at column
        } else {
            $sql .= " ORDER BY created_at ASC"; // Sort by oldest if needed
        }

        // Limit to the latest 6 jobs
        $sql .= " LIMIT 6";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($job = $result->fetch_assoc()) {
        // Output job details as needed
        $output .= "<div class='worker-card bg-white p-4 rounded shadow-md flex justify-between items-center'>";
        $output .= "<div class='flex-grow'>"; // This allows the content to take up available space
        $output .= "<h3 class='font-bold'>" . htmlspecialchars($job['job_title']) . "</h3>";
        $output .= "<p>Company: " . htmlspecialchars($job['company_name']) . "</p>";
        $output .= "<p>Location: " . htmlspecialchars($job['location']) . "</p>";
        $output .= "<p>Salary Range: " . htmlspecialchars($job['salary_range']) . "</p>";
        $output .= "<p>Job Type: " . htmlspecialchars($job['job_type']) . "</p>";
        $output .= "</div>";
        $output .= "<button class='bg-[rgb(34,197,94)] text-white py-2 px-4 rounded job-details hover:bg-green-600' 
                    onclick=\"window.location.href='job-details.php?job_id=" . $job['job_id'] . "'\">
                    Job Details
                    </button>";
                $output .= "</div>";
            }
        } else {
            $output .= '<div class="text-center">No jobs found.</div>'; // Message if no jobs are found
        }
        echo $output; // Echo the output here
    }
}
$conn->close();
?>