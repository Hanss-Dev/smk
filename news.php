<?php
require_once __DIR__ . "/config/database.php";
<?php include __DIR__ . "/includes/company/header.php";?>

$news = mysqli_query($conn,"
  SELECT * FROM news 
  WHERE status='publish' 
  ORDER BY id DESC
");
?>

<h2>Berita Perusahaan</h2>

<?php while($n = mysqli_fetch_assoc($news)): ?>
  <article>
    <img src="/uploads/news/<?= htmlspecialchars($n['thumbnail']); ?>" width="150">
    <h3>
      <a href="news-detail.php?slug=<?= $n['slug']; ?>">
        <?= htmlspecialchars($n['title']); ?>
      </a>
    </h3>
  </article>
<?php endwhile; ?>

<?php include __DIR__ . "/includes/company/footer.php"; ?>
