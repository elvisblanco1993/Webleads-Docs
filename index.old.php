<?php
  require __DIR__ . '/server/auth.php';
  require __DIR__ . '/libs/Parsedown.php';
  require __DIR__ . '/libs/ParsedownExtra.php';
  require __DIR__ . '/libs/BParsedown.php';
  require __DIR__ . '/server/db.php';
  require __DIR__ . '/server/functions.php';

  if ($user_loggedin == true) {
    require __DIR__ . '/server/app.php';
  }

  // Implement Parsedown
  $parse = new ParsedownExtra;

  // Initialize $clear_search_btn
  $clear_search_btn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/grid.css">
  <link rel="stylesheet" href="./assets/app.css">
  <title>Webleads Documentation and Support Center</title>
</head>
<body>
  <?php require_once __DIR__ . '/templates/header.php' ?>
  <?php require_once __DIR__ . '/templates/sidenav.php' ?>


      <!-- <?php
        if (isset($_GET['a'])) {

          require_once __DIR__ . '/templates/page.php';

        } elseif (isset($_GET['q']) && $_GET['q'] === 'new_article') {

          require_once __DIR__ . '/templates/create.php';

        } elseif (isset($_GET['e'])) {

          require_once __DIR__ . '/templates/edit.php';

        } elseif (isset($_POST['search'])) {

          $q = htmlentities(strip_tags($_POST['search']));

          require_once __DIR__ . '/templates/home.php';
          require_once __DIR__ . '/templates/search.php';
          require_once __DIR__ . '/templates/contact.php';
          
        } else {

          require_once __DIR__ . '/templates/home.php';
          require_once __DIR__ . '/templates/articles.php';
          require_once __DIR__ . '/templates/contact.php';

        }

        if ($user_loggedin == true) {

          require __DIR__ . '/templates/modals.php';
          
        }
      ?> -->

  <?php require_once __DIR__ . '/templates/footer.php' ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
