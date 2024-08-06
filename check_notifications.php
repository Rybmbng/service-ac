<?php
// Sample check_notifications.php
include_once 'controller/config.php';

// Assume you retrieve notification count from your database or somewhere else
$notification_count = 5; // Replace with your actual logic to get notification count

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['count' => $notification_count]);
?>
