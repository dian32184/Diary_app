<?php
include "../database/database.php";

// Function to get the next available ID
function getNextAvailableId($conn) {
    $result = $conn->query("SELECT MIN(id) AS min_id FROM entries");
    
    if (!$result) {
        die('Query Error: ' . $conn->error);
    }

    $row = $result->fetch_assoc();
    $minId = $row['min_id'];

    // If there are no entries, start from ID 1
    if ($minId === null) {
        return 1;
    }

    $nextId = $minId > 1 ? $minId : 1;

    while (true) {
        $check = $conn->query("SELECT id FROM entries WHERE id = $nextId");
        
        if (!$check) {
            die('Query Error: ' . $conn->error);
        }
        
        if ($check->num_rows == 0) {
            return $nextId;
        }
        $nextId++;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    $nextId = getNextAvailableId($conn);

    $stmt = $conn->prepare("INSERT INTO entries (id, title, content) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        die('Prepare Error: ' . $conn->error);
    }

    $stmt->bind_param("iss", $nextId, $title, $content);
    
    if (!$stmt->execute()) {
        die('Execute Error: ' . $stmt->error);
    }
    
    $stmt->close();

    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Diary Entry</title>
    <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5">
      <div class="col-6">
        <div class="row text-center">
          <p class="display-5 fw-bold">Add Diary Entry</p>
        </div>
        <form action="add_entry.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea id="content" name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Entry</button>
        </form>
        <div class="mt-3">
            <a href="../index.php" class="btn btn-secondary">Back to Entries</a>
        </div>
      </div>
    </div>
</body>
</html>
