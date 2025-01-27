<?php
    include '../connect.php';

    // Check if ID is provided in URL
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // SQL query to delete the user from the database
        $delete_query = "DELETE FROM users WHERE id = '$user_id'";

        // Execute the query
        if (mysqli_query($conn, $delete_query)) {
            // Redirect back to the user management page after deletion
            header('Location: user-management.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "No user ID provided!";
    }
?>
