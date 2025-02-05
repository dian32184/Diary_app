<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Diary Entry</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold">Create Diary Entry</p>
      </div>
      <div class="row">
        <form class="form" action="../handlers/add_diary_handler.php" method="POST">
          <div class="my-3">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" required />
          </div>
          <div class="my-3">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" required></textarea>
          </div>
          <div class="my-3">
            <button type="submit" class="btn btn-outline-dark">Create Diary Entry</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>