<?php
session_start();
require '../connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $jobId = isset($_POST['job_id']) ? intval($_POST['job_id']) : null;
    $workerId = isset($_POST['worker_id']) ? intval($_POST['worker_id']) : null;
    $expectedSalary = isset($_POST['expected_salary']) ? floatval($_POST['expected_salary']) : null;
    $negotiationInput = isset($_POST['price']) ? floatval($_POST['price']) : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    // Retrieve the logged-in user's ID
    $userId = isset($_SESSION['id']) ? intval($_SESSION['id']) : null;

    // Validate inputs
    if (!$jobId || !$workerId || !$expectedSalary || $negotiationInput <= 0 || !$userId || !$action) {
        echo "<div class='text-red-500'>Invalid input. Please ensure all fields are filled correctly.</div>";
        exit;
    }

    // Log all received values in the browser console
    echo "<script>console.log('Received Data: jobId={$jobId}, workerId={$workerId}, expectedSalary={$expectedSalary}, negotiationInput={$negotiationInput}, action={$action}, userId={$userId}');</script>";

    // Handle different actions based on form submission
    switch ($action) {
        case 'accept':
            // Fetch the negotiated price and job title
            $negotiationDetailsSql = "SELECT negotiations.negotiated_amount, jobs.job_title, jobs.user_id AS poster_id 
                                      FROM negotiations 
                                      JOIN jobs ON negotiations.job_id = jobs.job_id 
                                      WHERE negotiations.job_id = ? AND negotiations.worker_id = ? AND negotiations.user_id = ?";
            $detailsStmt = $conn->prepare($negotiationDetailsSql);
            if ($detailsStmt) {
                $detailsStmt->bind_param("iii", $jobId, $workerId, $userId);
                $detailsStmt->execute();
                $detailsResult = $detailsStmt->get_result();
                if ($detailsResult->num_rows > 0) {
                    $details = $detailsResult->fetch_assoc();
                    $negotiatedPrice = $details['negotiated_amount'];
                    $jobTitle = $details['title'];
                    $jobPosterId = $details['poster_id'];
        
                    // Update the negotiation status
                    $updateSql = "UPDATE negotiations SET status = 'accepted' WHERE job_id = ? AND worker_id = ? AND user_id = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    if ($updateStmt) {
                        $updateStmt->bind_param("iii", $jobId, $workerId, $userId);
                        if ($updateStmt->execute()) {
                            // Send notification to the job poster
                            $notificationMessage = "Worker ID: $workerId has accepted the job '$jobTitle' at a price of $negotiatedPrice.";
                            $notificationSql = "INSERT INTO notificationsJobs (worker_id, message, job_id, is_read) 
                                                VALUES (?, ?, ?, ?)";
                            $notificationStmt = $conn->prepare($notificationSql);
                            if ($notificationStmt) {
                                $isRead = 0; // Notification status for unread
                                $notificationStmt->bind_param("issi", $jobPosterId, $notificationMessage, $jobId, $isRead);
                                if ($notificationStmt->execute()) {
                                    // Display success alert
                                    echo "<script>
                                        alert('You successfully signed the job \"$jobTitle\" at price $negotiatedPrice.');
                                        window.location.href = 'home-worker.php'; // Redirect to a desired page
                                    </script>";
                                } else {
                                    echo "<div class='text-red-500'>Error sending notification: " . htmlspecialchars($notificationStmt->error) . "</div>";
                                }
                                $notificationStmt->close();
                            } else {
                                echo "<div class='text-red-500'>Error preparing notification query: " . htmlspecialchars($conn->error) . "</div>";
                            }
                        } else {
                            echo "<div class='text-red-500'>Error updating negotiation status: " . htmlspecialchars($updateStmt->error) . "</div>";
                        }
                        $updateStmt->close();
                    } else {
                        echo "<div class='text-red-500'>Error preparing update query: " . htmlspecialchars($conn->error) . "</div>";
                    }
                } else {
                    echo "<div class='text-red-500'>No negotiation details found.</div>";
                }
                $detailsStmt->close();
            } else {
                echo "<div class='text-red-500'>Error preparing details query: " . htmlspecialchars($conn->error) . "</div>";
            }
            break;
        

            case 'decline':
                // Fetch the job title and job poster ID
                $declineDetailsSql = "SELECT jobs.job_title, jobs.user_id AS poster_id 
                                      FROM jobs 
                                      WHERE jobs.job_id = ?";
                $declineStmt = $conn->prepare($declineDetailsSql);
                if ($declineStmt) {
                    $declineStmt->bind_param("i", $jobId);
                    $declineStmt->execute();
                    $declineResult = $declineStmt->get_result();
                    if ($declineResult->num_rows > 0) {
                        $details = $declineResult->fetch_assoc();
                        $jobTitle = $details['title'];
                        $jobPosterId = $details['poster_id'];
            
                        // Update the negotiation status to declined
                        $updateDeclineSql = "UPDATE negotiations SET status = 'declined' WHERE job_id = ? AND worker_id = ? AND user_id = ?";
                        $updateDeclineStmt = $conn->prepare($updateDeclineSql);
                        if ($updateDeclineStmt) {
                            $updateDeclineStmt->bind_param("iii", $jobId, $workerId, $userId);
                            if ($updateDeclineStmt->execute()) {
                                // Send notification to the job poster
                                $declineNotificationMessage = "Worker ID: $workerId has declined the job '$jobTitle'.";
                                $declineNotificationSql = "INSERT INTO notificationsJobs (worker_id, message, job_id, is_read) 
                                                           VALUES (?, ?, ?, ?)";
                                $declineNotificationStmt = $conn->prepare($declineNotificationSql);
                                if ($declineNotificationStmt) {
                                    $isRead = 0; // Notification status for unread
                                    $declineNotificationStmt->bind_param("issi", $jobPosterId, $declineNotificationMessage, $jobId, $isRead);
                                    if ($declineNotificationStmt->execute()) {
                                        // Display success alert
                                        echo "<script>
                                            alert('You have declined the job \"$jobTitle\".');
                                            window.location.href = 'home-worker.php'; // Redirect to a desired page
                                        </script>";
                                    } else {
                                        echo "<div class='text-red-500'>Error sending decline notification: " . htmlspecialchars($declineNotificationStmt->error) . "</div>";
                                    }
                                    $declineNotificationStmt->close();
                                } else {
                                    echo "<div class='text-red-500'>Error preparing decline notification query: " . htmlspecialchars($conn->error) . "</div>";
                                }
                            } else {
                                echo "<div class='text-red-500'>Error updating negotiation status to declined: " . htmlspecialchars($updateDeclineStmt->error) . "</div>";
                            }
                            $updateDeclineStmt->close();
                        } else {
                            echo "<div class='text-red-500'>Error preparing decline update query: " . htmlspecialchars($conn->error) . "</div>";
                        }
                    } else {
                        echo "<div class='text-red-500'>No job details found for the declined action.</div>";
                    }
                    $declineStmt->close();
                } else {
                    echo "<div class='text-red-500'>Error preparing decline details query: " . htmlspecialchars($conn->error) . "</div>";
                }
                break;
            
            case 'negotiate':
                // Insert a new negotiation record
                $negotiatedAmount = $negotiationInput;
            
                // Insert negotiation into the database
                $sql = "INSERT INTO negotiations (user_id, job_id, worker_id, offer_amount, negotiated_amount) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("iiidd", $userId, $jobId, $workerId, $expectedSalary, $negotiatedAmount);
                    if ($stmt->execute()) {
                        // Fetch the job poster's ID
                        $jobPosterIdSql = "SELECT user_id FROM jobs WHERE job_id = ?"; // Corrected line
                        $jobPosterStmt = $conn->prepare($jobPosterIdSql);
                        $jobPosterStmt->bind_param("i", $jobId);
                        $jobPosterStmt->execute();
                        $jobPosterResult = $jobPosterStmt->get_result();
                        $jobPosterId = $jobPosterResult->fetch_assoc()['user_id'];
            
                        // Send notification to the worker about the negotiation
                        $notificationMessage = "New negotiation for Job ID: $jobId from User ID: $userId. Negotiated Amount: $negotiatedAmount";
                        $notificationSql = "INSERT INTO notificationsJobs (worker_id, message, job_id, is_read) 
                                            VALUES (?, ?, ?, ?)";
                        $notificationStmt = $conn->prepare($notificationSql);
                        if ($notificationStmt) {
                            $isRead = 0; // Notification status for unread
                            $notificationStmt->bind_param("issi", $jobPosterId, $notificationMessage, $jobId, $isRead);
                            if ($notificationStmt->execute()) {
                                echo "<div class='text-green-500'>Negotiation submitted successfully. Notification sent to Worker ID: $jobPosterId.</div>";
                            } else {
                                echo "<div class='text-red-500'>Error sending notification: " . htmlspecialchars($notificationStmt->error) . "</div>";
                            }
                            $notificationStmt->close();
                        } else {
                            echo "<div class='text-red-500'>Error preparing notification query: " . htmlspecialchars($conn->error) . "</div>";
                        }
                        $jobPosterStmt->close();
                    } else {
                        echo "<div class='text-red-500'>Error submitting negotiation: " . htmlspecialchars($stmt->error) . "</div>";
                    }
                    $stmt->close();
                } else {
                    echo "<div class='text-red-500'>Error preparing negotiation statement: " . htmlspecialchars($conn->error) . "</div>";
                }
                break;

        default:
            echo "<div class='text-red-500'>Invalid action.</div>";
            break;
    }
} else {
    echo "<div class='text-red-500'>Invalid request method.</div>";
}
?>