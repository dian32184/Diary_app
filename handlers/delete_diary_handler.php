<?php

include "../database/database.php";

try {
    // Check if 'id' is set and is a numeric value
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id']; // Cast to integer for safety

        // Prepare the SQL statement to delete an entry by its ID
        $stmt = $conn->prepare("DELETE FROM entries WHERE id = ?");

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect after successful deletion
            header("Location: ../index.php");
            exit;
        } else {
            echo "Operation failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid ID provided.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}