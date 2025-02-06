<?php
include "../database/database.php";

try {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id'];

        // Prepare the SQL statement to delete an entry by its ID
        $stmt = $conn->prepare("DELETE FROM entries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header("Location: ../index.php");
        exit;
    } else {
        echo "Invalid ID provided.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
