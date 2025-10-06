<?php

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
            request_en AS request
    FROM    marys_requests AS mr
    WHERE   mr.event_id = :id
  SQL;
  $stmt = $pdo->prepare($sql);

  // Bind the value safely
  $stmt->execute([':id' => $id]);

  // Fetch a single row
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



