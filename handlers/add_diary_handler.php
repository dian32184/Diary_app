<?php

include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Validate input
        $title = trim($_POST['title']);
        $content = trim($_POST['content']); // Changed to 'content'

        if (empty($title) || empty($content)) {
            echo "Title and content cannot be empty.";
            exit;
        }

        // Prepare the SQL statement without user_id
        $stmt = $conn->prepare("INSERT INTO entries (title, content) VALUES (?, ?)");

        // Check if the statement was prepared successfully
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind parameters (removed user_id)
        $stmt->bind_param("ss", $title, $content); // Updated binding

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Operation failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}