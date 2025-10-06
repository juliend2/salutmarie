<?php

$pdo = new PDO("sqlite:" . __DIR__ . "/../data/data.sqlite3");


include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../lib/repository.php';

?>

<?php if (isset($_GET['id'])): ?>

  <?php

  $event = getEventByID($pdo, $_GET['id']);
  $requests = getRequestsByEventID($pdo, $_GET['id']);

  if ($event) {
    ?>
    <div class="deux-colonnes">
      <div class="colonne-principale">
        <h2 class="display"><?= $event['name'] ?></h2>
        <p>
          <?= nl2br(htmlspecialchars($event['description'])) ?>
        </p>
      </div>
      <div class="barre-laterale">
        <ul>
          <?php foreach ($requests as $r): ?>
          <li>
            <?= htmlspecialchars($r['request']) ?>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
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
