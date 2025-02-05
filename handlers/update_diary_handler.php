<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        // Get and validate input
        $title = trim($_POST['title']);
        $content = trim($_POST['content']); // Changed to 'content'
        $id = (int)$_POST['id'];

        // Validate required fields
        if (empty($title) || empty($content) || empty($id)) {
            echo "Title, content, and ID cannot be empty.";
            exit;
        }

        // Prepare the SQL statement for the entries table
        $stmt = $conn->prepare("UPDATE entries SET title = ?, content = ? WHERE id = ?");

        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind the parameters
        $stmt->bind_param("ssi", $title, $content, $id); // Updated binding

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