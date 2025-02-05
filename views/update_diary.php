<?php
include '../database/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if ID is set in the URL
if (!isset($_GET['id'])) {
    die("Error: ID not specified.");
}

$id = (int)$_GET['id'];

// Fetch the entry from the database
$res = $conn->query("SELECT * FROM entries WHERE id = $id");

if ($res->num_rows === 0) {
    die("Error: Entry not found.");
}

$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Diary Entry</title>
    <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-6">
            <div class="row">
                <p class="display-5 fw-bold">Update Diary Entry</p>
            </div>
            <div class="row">
                <form action="../handlers/update_diary_handler.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($row['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" required><?= htmlspecialchars($row['content']); ?></textarea>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Update Entry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>