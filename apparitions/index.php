<?php

$pdo = new PDO("sqlite:" . __DIR__ . "/../data/data.sqlite3");


include __DIR__ . '/../includes/header.php';
?>

<?php if (isset($_GET['id'])): ?>


  <?php
  $sql = "SELECT id, name, description FROM events WHERE id = :id";
  $stmt = $pdo->prepare($sql);

  // Bind the value safely
  $stmt->execute([':id' => 1]);

  // Fetch a single row
  $event = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($event) {
    ?>
    <h1><?= $event['name'] ?></h1>
    <p>
      <?= nl2br($event['description']) ?>
    </p>
    <?php
  } else {
      echo "Mauvaise adresse, désolé.";
  }
  ?>

<?php else: ?>
  <?php

  $stmt = $pdo->query("SELECT id, name FROM events");

  ?>
  <ul>
  <?php foreach ($stmt as $row): ?>
    <li>
      <a href="?id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
    </li>
  <?php endforeach ?>
  </ul>

<?php endif ?>

<?php 
include __DIR__ . '/../includes/footer.php';
