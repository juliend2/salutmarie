<?php

$pdo = new PDO("sqlite:" . __DIR__ . "/../data/data.sqlite3");

// Example: read all rows
$stmt = $pdo->query("SELECT id, name FROM events");


include __DIR__ . '/../includes/header.php';
?>

<!-- Preview -->
      <section id="preview">
        <h2>Preview</h2>
        <p>
          Sed ultricies dolor non ante vulputate hendrerit. Vivamus sit amet suscipit sapien. Nulla
          iaculis eros a elit pharetra egestas.
        </p>
        <form>
          <div class="grid">
            <input
              type="text"
              name="firstname"
              placeholder="First name"
              aria-label="First name"
              required
            >
            <input
              type="email"
              name="email"
              placeholder="Email address"
              aria-label="Email address"
              autocomplete="email"
              required
            >
            <button type="submit">Subscribe</button>
          </div>
          <fieldset>
            <label for="terms">
              <input type="checkbox" role="switch" id="terms" name="terms">
              I agree to the
              <a href="#" onclick="event.preventDefault()">Privacy Policy</a>
            </label>
          </fieldset>
        </form>
      </section>


<?php foreach ($stmt as $row): ?>
    <a href="?id=<?= $row['id'] ?><?= $row['name'] ?></a>
<?php endforeach ?>


<?php 
include __DIR__ . '/../includes/footer.php';
