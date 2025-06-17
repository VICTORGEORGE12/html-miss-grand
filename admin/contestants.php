<?php
require '../includes/auth.php';
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add contestant
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $photoPath = '';

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $uploadDir = '../../images/'; // from admin/ to images/
            $fileName = time() . '_' . basename($_FILES['photo']['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $photoPath = 'images/' . $fileName; // path saved in DB
            }
        }

        $stmt = $conn->prepare("INSERT INTO contestants (name, photo) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $photoPath);
        $stmt->execute();

        header("Location: contestants.php");
        exit;
    }

    // Delete contestant
    if (isset($_POST['delete']) && isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];

        // Get image path before deleting
        $getImg = $conn->prepare("SELECT photo FROM contestants WHERE id=?");
        $getImg->bind_param("i", $id);
        $getImg->execute();
        $imgRes = $getImg->get_result()->fetch_assoc();
        if ($imgRes && $imgRes['photo']) {
            $imgPath = '../../' . $imgRes['photo'];
            if (file_exists($imgPath)) unlink($imgPath); // Delete file
        }

        // Try delete from DB
        $stmt = $conn->prepare("DELETE FROM contestants WHERE id=?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            $error = "Error: Cannot delete contestant. Votes exist for this contestant.";
        }

        header("Location: contestants.php");
        exit;
    }
}

$res = $conn->query("SELECT * FROM contestants");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Contestants</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2 class="mb-4">Manage Contestants</h2>
  <a href="dashboard.php" class="btn btn-secondary mb-4">« Back to Dashboard</a>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <!-- Add Contestant Form -->
  <form method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-white shadow-sm mb-5">
    <div class="mb-3">
      <label for="name" class="form-label">Contestant Name</label>
      <input name="name" id="name" placeholder="Name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="photo" class="form-label">Upload Photo</label>
      <input type="file" name="photo" id="photo" accept="image/*" class="form-control" required>
    </div>
    <button name="add" class="btn btn-success">Add Contestant</button>
  </form>

  <!-- Contestants Table -->
  <table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Name</th>
        <th>Photo</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($c = $res->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($c['name']) ?></td>
        <td>
          <?php if ($c['photo']): ?>
            <img src="../../<?= htmlspecialchars($c['photo']) ?>" width="60" class="img-thumbnail">
          <?php else: ?>
            <span class="text-muted">No photo</span>
          <?php endif; ?>
        </td>
        <td>
          <form method="POST" onsubmit="return confirm('Are you sure you want to delete this contestant?');" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?= $c['id'] ?>">
            <button name="delete" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
