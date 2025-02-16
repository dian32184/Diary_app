<?php 
include 'database/database.php'; // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Diary App</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
      <div class="col-6">
        <div class="row text-center">
          <p class="display-5 fw-bold">Diary App</p>
        </div>
        <div class="row mb-3">
          <a href="views/add_entry.php" class="btn btn-outline-dark btn-sm">Add Diary Entry</a>
        </div>

        <?php
          $res = $conn->query("SELECT * FROM entries"); // Fetch all diary entries

          if ($res === false) {
              die("Query failed: " . $conn->error);
          }
        ?>

        <?php if($res->num_rows > 0): ?>
            <?php while($row = $res->fetch_assoc()): ?>
            <div class="row border rounded p-3 my-3">
                <div>
                    <h5 class="fw-bold"><?= htmlspecialchars($row['title']); ?> 
                        <small class="text-muted">(<?= htmlspecialchars($row['date_added']); ?>)</small>
                    </h5> 
                    <p class="text-secondary"><?= nl2br(htmlspecialchars($row['content'])); ?></p>
                    <div class="row my-1">
                        <a href="views/update_diary.php?id=<?= urlencode($row['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="handlers/delete_diary_handler.php?id=<?= urlencode($row['id']); ?>" class="btn btn-sm btn-danger ms-2">Delete</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="row border rounded p-3 my-3 text-center">
                <div class="col mt-3">
                    <p class="text-muted">🎉 No current entries! Time to reflect or add new entries.</p>
                </div>
            </div>
        <?php endif; ?>
      </div>
    </div>
</body>

</html>
