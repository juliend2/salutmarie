<?php

$pdo = new PDO("sqlite:" . __DIR__ . "/../data/data.sqlite3");


include __DIR__ . '/../includes/header.php';

function getEventByID($pdo, $id) {
  $sql = <<<SQL
    SELECT
            e.id, e.name, e.description
    FROM    events AS e
    WHERE   e.id = :id
    LIMIT   1
  SQL;
  $stmt = $pdo->prepare($sql);

  // Bind the value safely
  $stmt->execute([':id' => $id]);

  // Fetch a single row
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getRequestsByEventID($pdo, $id) {
  $sql = <<<SQL
    SELECT
            request
    FROM    marys_requests AS mr
    WHERE   mr.event_id = :id
  SQL;
  $stmt = $pdo->prepare($sql);

  // Bind the value safely
  $stmt->execute([':id' => $id]);

  // Fetch a single row
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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
          <?= nl2br($event['description']) ?>
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
