<?php
include "../database/database.php";

$id = (int)$_GET['id'];
if ($id <= 0) {
    die("Invalid ID");
}

$stmt = $conn->prepare("SELECT title, content FROM entries WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Entry not found");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Diary Entry</title>
    <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Diary Entry</h2>
        <form method="POST" action="../handlers/update_diary_handler.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($row['content']); ?></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Entry</button>
                <a href="../index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script src="../statics/js/bootstrap.bundle.min.js"></script>
</body>

</html>
