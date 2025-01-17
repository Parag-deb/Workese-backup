<?php
session_start();
session_destroy(); // Destroy the session
header("Location: /home/index.html"); // Redirect to home or login page
exit();
?>