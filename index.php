<?php require_once __DIR__ . '/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://webleads.app/app/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/app.css">
  <script src="assets/tawkto.js" charset="utf-8"></script>
  <title>Webleads Documentation and Support Center</title>
</head>
<body>
  <?php require_once __DIR__ . '/templates/header.php' ?>
  <div class="container">
    <div class="row">

      <?php
        if (isset($_GET['a'])) {
          require_once __DIR__ . '/templates/sidenav.php';
          require_once __DIR__ . '/templates/page.php';

          if ($user_loggedin == true) {
            require __DIR__ . '/templates/modals.php';
          }

        } elseif (isset($_GET['q']) && $_GET['q'] === 'new_article') {

          require_once __DIR__ . '/templates/create.php';

        } elseif (isset($_GET['e'])) {

          require_once __DIR__ . '/templates/edit.php';

        } elseif (isset($_POST['search'])) {

          $q = htmlentities(strip_tags($_POST['search']));

          require_once __DIR__ . '/templates/home.php';
          require_once __DIR__ . '/templates/search.php';

        } else {
          require_once __DIR__ . '/templates/home.php';
          require_once __DIR__ . '/templates/articles.php';

        }
      ?>
    </div>
  </div>
  <?php require_once __DIR__ . '/templates/footer.php'; ?>
</body>
<script src="assets/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
