<?php
include "connect.php";

if (isset($_POST['action'])) {
    $output = '';
    if ($_POST['action'] == 'fetchData') { // Ensure this matches your AJAX call
        $query = "SELECT * FROM jobs";
        $output = getData($query);
        echo $output; // Echo the output here
    }
    //Search By Employee Name
    if($_POST['action'] == 'searchRecord'){
        $job_title = $_POST['job_title'];
        $query = "SELECT * FROM jobs WHERE job_title LIKE '%$job_title%'";
        $output = getData($query);
        echo $output;
    }

    // apply checkbox filtering
    // if ($_POST['action'] == 'applyFilter') {
    //     $filters = $_POST['filters'];
    
    //     $query = "SELECT * FROM jobs WHERE 1=1";
    
    //     if (!empty($filters['categories'])) {
    //         $categories = implode("','", array_map('mysqli_real_escape_string', $filters['categories']));
    //         $query .= " AND category IN ('$categories')";
    //     }
    
    //     if (!empty($filters['jobTypes'])) {
    //         $jobTypes = implode("','", array_map('mysqli_real_escape_string', $filters['jobTypes']));
    //         $query .= " AND jobType IN ('$jobTypes')";
    //     }
    
    //     if (!empty($filters['salary'])) {
    //         $salary = (int) $filters['salary'];
    //         $query .= " AND salary <= $salary";
    //     }
    
    //     $output = getData($query);
    //     echo $output;
    // }
    
    
}

function getData($query) {
    include("connect.php");
    $output = "";
    $total_row = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($total_row) > 0) {
        foreach ($total_row as $row) {
            $output .= '
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <span class="bg-green-100 text-green-500 py-1 px-2 rounded">
                            10 min ago
                        </span>
                        <div>
                            <h3 class="text-xl font-semibold">
                                ' . htmlspecialchars($row['job_title']) . '
                            </h3>
                            <p class="text-gray-500">
                                ' . htmlspecialchars($row['company_name']) . '
                            </p>
                            <div class="flex items-center space-x-2 text-gray-500 mt-2">
                                <span>
                                    <i class="fas fa-clock"></i>
                                    ' . htmlspecialchars($row['job_type']) . '
                                </span>
                                <span>
                                    <i class="fas fa-dollar-sign"></i>
                                    ' . htmlspecialchars($row['salary_range']) . '
                                </span>

                            </div>
                        </div>
                         </div>
            <button 
                class="bg-[rgb(34,197,94)] text-white py-2 px-4 rounded job-details hover:bg-green-600" 
                onclick="window.location.href=\'job-details.php?job_id=' . $row['job_id'] . '\'">
                Job Details
            </button>





                </div>
            </div>
            ';
        }
    } else {
        $output .= '<div class="text-center">No jobs found.</div>'; // Message if no jobs are found
    }
    return $output; // Return the output instead of echoing it here
}
?>