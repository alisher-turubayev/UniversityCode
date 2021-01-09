<?php
require './includes/library.php';
$pdo = connectDB();

$query = "SELECT id, name FROM cois3420_candies";
$statement = $pdo->prepare($query);

$statement->execute([]);

$results = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Vote for Wonka's Next Candy!";
  include "./includes/metadata.php";
  ?>
  <script src="./scripts/voting.js"></script>
</head>
<body>
  <?php include "./includes/header.php"; ?>
  <main>
    <h1>Vote for Wonka's<sup>&reg;</sup> next candy!</h1>
    <form id="main-form" action="./processvote.php" method="post">
      <div id="name-container">
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" placeholder="John Smith">
      </div>
      <div id="email-container">
        <label for="email">Email Address:</label>
        <input id="email" name="email" type="text" placeholder="john.smith@gmail.com">
      </div>
      <fieldset id="perspective-container">
        <legend>Perspective</legend>
        <div>
          <input id="radio-customer" name="perspective" type="radio" value="customer">
          <label for="radio-customer">Customer</label>
        </div>
        <div>
          <input id="radio-reseller" name="perspective" type="radio" value="reseller">
          <label for="radio-reseller">Reseller</label>
        </div>
        <div>
          <input id="radio-oompa" name="perspective" type="radio" value="oompa">
          <label for="radio-oompa">Oompa-Loompa</label>
        </div>
      </fieldset>
      <div id="choice-container" class="centered">
        <label for="choice">Product Choice:</label>
        <select id="choice" name="choice">
          <option value="-1" selected>Select an option</option>
          <?php foreach ($results as $row): ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div id="agree-container" class="centered">
        <input id="agree" type="checkbox" name="agree">
        <label for="agree">I agree to the <a href="">Terms and Conditions</a>.</label>
      </div>
      <button id="form-submit" class="centered">Submit Vote</button>
    </form>
  </main>
  <?php include "./includes/footer.php"; ?>
  <!-- Fix for Chrome bug, leave this. https://stackoverflow.com/a/42969608 -->
  <script> </script>
</body>

</html>
