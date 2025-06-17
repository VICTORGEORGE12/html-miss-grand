<?php require 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vote - Miss Grand Tanzania</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a2e8f2f414.js" crossorigin="anonymous"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

  
 <style>
  body {
    background: linear-gradient(to right, #fff8e1, #fffde7);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .vote-header {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: #302801;
    text-shadow: 1px 1px 2px #f5e042;
  }

  .card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.2s ease-in-out, box-shadow 0.3s;
    height: auto; /* Card grows with image */
  }

  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.15);
  }

  .card-img-top {
    width: 100%;
    height: auto; /* Natural height of image */
    object-fit: contain; /* Preserve entire image */
    display: block;
  }

  .card-body {
    text-align: center;
  }

  .vote-btn {
    background-color: #ffdc34;
    color: #302801;
    font-weight: 600;
    border-radius: 10px;
    transition: 0.3s;
  }

  .vote-btn:hover {
    background-color: #e6c800;
    color: #fff;
  }

  .navbar-brand img {
    height: 100px;
    object-fit: contain;
  }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color:rgb(14, 11, 0);">
  <div class="container-fluid px-4">
    <a class="navbar-brand d-flex align-items-center text-white" href="#">
      <!-- Enlarged Logo Without Restrictive Classes -->
      <img src="../images/cover photo-1.png" alt="Logo" style="height: 100px; max-height: 100px; object-fit: contain;" class="me-3">
      <span class="fw-bold fs-2" style="color: #ffdc34;">Miss Grand Tanzania</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background-color:#ffdc34;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white fw-semibold" href="../index.html">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>





<!-- ✅ Voting Section -->
<div class="container py-5">
  <h2 class="text-center vote-header mb-5">Vote for Your Favorite Miss Grand Tanzania Contestant</h2>
  <div class="row g-4">

    <?php if (isset($_GET['voted']) && $_GET['voted'] == 1): ?>
      <div class="container mt-4">
         <div class="alert alert-warning text-center fw-bold shadow-sm">
            Umeshapiga kura tayari. Asante kwa ushiriki wako!
         </div>
       </div>
    <?php endif; ?>

    <?php
      $res = $conn->query("SELECT * FROM contestants");
      while ($c = $res->fetch_assoc()):
    ?>
    <div class="col-md-6 col-lg-4">
      <div class="card shadow">
        <?php if ($c['photo']): ?>
          <img src="../<?= htmlspecialchars($c['photo']) ?>" class="card-img-top" alt="<?= htmlspecialchars($c['name']) ?>">
        <?php endif; ?>
        <div class="card-body text-center">
          <h5 class="card-title mb-3"><?= htmlspecialchars($c['name']) ?></h5>
          <form action="vote.php" method="POST" onsubmit="return confirmVote('<?= addslashes($c['name']) ?>')">
             <input type="hidden" name="contestant_id" value="<?= $c['id'] ?>">
             <button class="btn vote-btn w-100">Vote</button>
         </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>


<!-- Confirm Vote JS -->
<script>
function confirmVote(name) {
  return confirm("Uko tayari kupiga kura kwa ajili ya " + name + "?");
}
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
