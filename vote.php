<?php
require 'includes/db.php';

// Get contestant ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contestant_id'])) {
    $contestant_id = (int)$_POST['contestant_id'];

    // Get user's IP address
    $ip = $_SERVER['REMOTE_ADDR'];

    // Check if this IP has already voted
    $stmt = $conn->prepare("SELECT id FROM votes WHERE ip_address = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Already voted
        header("Location: votingForm.php?voted=1");
        exit;
    }

    // Save the vote
    $stmt = $conn->prepare("INSERT INTO votes (contestant_id, ip_address) VALUES (?, ?)");
    $stmt->bind_param("is", $contestant_id, $ip);
    if ($stmt->execute()) {
        // Vote successful
        header("Location: votingForm.php?voted=success");
        exit;
    } else {
        // DB error
        header("Location: votingForm.php?voted=error");
        exit;
    }
} else {
    // Invalid request
    header("Location: votingForm.php");
    exit;
}
