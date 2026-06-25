<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . "/config/database.php";

if (!isset($_GET['slug'])) {
  die("Berita tidak ditemukan.");
}

$slug = mysqli_real_escape_string($conn, $_GET['slug']);

$query = mysqli_query($conn, "SELECT * FROM news WHERE slug='$slug' LIMIT 1");

if (!$query) {
  die(mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
  die("Berita tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

include __DIR__ . "/includes/company/header.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($data['title']); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>

  body.nx-body {
    font-family: 'Poppins', sans-serif;
    background: #f4f7fb;
    margin: 0;
    color: #1a1a1a;
  }

  .nx-container {
    max-width: 900px;
    margin: 60px auto;
    padding: 20px;
  }

  .nx-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    overflow: hidden;
  }

  /* ===== IMAGE ===== */
  .nx-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
  }

  /* ===== CONTENT ===== */
  .nx-content {
    padding: 30px;
  }

  /* ===== TITLE ===== */
  .nx-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
  }

  /* ===== META ===== */
  .nx-meta {
    font-size: 14px;
    color: #888;
    margin-bottom: 20px;
  }

  /* ===== CONTENT TEXT ===== */
  .nx-text {
    line-height: 1.8;
    font-size: 16px;
    color: #333;
  }

  .nx-text p {
    margin-bottom: 16px;
  }

  .nx-tags {
    margin-top: 25px;
  }

  .nx-tag {
    display: inline-block;
    background: #e8f0ff;
    color: #2a5bd7;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    margin: 4px;
    text-decoration: none;
  }

  .nx-back {
    display: inline-block;
    margin-top: 30px;
    text-decoration: none;
    background: #041d54;
    color: #fff;
    padding: 10px 18px;
    border-radius: 8px;
    transition: 0.3s;
  }

  .nx-back:hover {
    background: #0a2c7d;
  }

  @media (max-width: 600px) {
    .nx-title {
      font-size: 22px;
    }

    .nx-image img {
      height: 250px;
    }
  }

  </style>
</head>

<body class="nx-body">

<div class="nx-container">
  <div class="nx-card">

    <?php if (!empty($data['thumbnail'])): ?>
      <div class="nx-image">
        <img src="uploads/news/<?= htmlspecialchars($data['thumbnail']); ?>" alt="">
      </div>
    <?php endif; ?>


    <div class="nx-content">

      <h1 class="nx-title">
        <?= htmlspecialchars($data['title']); ?>
      </h1>

      <div class="nx-meta">
        📅 <?= date('d F Y', strtotime($data['created_at'])); ?>
      </div>

      <div class="nx-text">
        <?= $data['content']; ?>
      </div>

      <a href="index.php#berita" class="nx-back">← Kembali</a>

    </div>

  </div>
</div>

</body>
</html>

<?php include __DIR__ . "/includes/company/footer.php"; ?>