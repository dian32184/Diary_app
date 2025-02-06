<?php
include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Validate input
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (empty($title) || empty($content)) {
            echo "Title and content cannot be empty.";
            exit;
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO entries (title, content) VALUES (?, ?)");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ss", $title, $content);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the index page after successful insertion
            header("Location: ../index.php");
            exit;
        } else {
            echo "Operation failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
} catch (Exception $e) {
    // Display the error message
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection if it was established
    if ($conn) {
        $conn->close();
    }
} 
