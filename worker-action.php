<?php
include "connect.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['action'])) {
    $output = '';
    if ($_POST['action'] == 'fetchData') {
        $query = "SELECT * FROM workers JOIN users ON workers.user_id = users.id";
        $output = getData($query);
        echo $output; // Echo the output here
    }
}

function getData($query) {
    include("connect.php");
    $output = "";
    $total_row = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($total_row) > 0) {
        foreach ($total_row as $row) {
            $output .= '
            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
                
                <h2 class="text-lg font-bold">' . htmlspecialchars($row['name']) . '</h2>
                <p class="text-gray-600">' . htmlspecialchars($row['experience']) . '</p>
                <p class="text-gray-600">Experience: ' . htmlspecialchars($row['skills']) . '</p>
                <button class="mt-4 bg-[rgb(34,197,94)] text-white py-2 px-4 rounded hover:bg-green-600">Send Request</button>
            </div>';
        }
    } else {
        $output .= '<p>No workers found.</p>';
    }
    return $output;
}
?>