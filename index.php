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
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/app.css">
  <title>Webleads Documentation</title>
</head>
<body>
  <?php require_once __DIR__ . '/__includes/header.php' ?>

  <div class="container-fluid">
    <div class="row">
      <?php
        if (isset($_GET['a'])) {

          require_once __DIR__ . '/__includes/page.php';

        } elseif (isset($_GET['q']) && $_GET['q'] === 'new_article') {

          require_once __DIR__ . '/__includes/create.php';

        } elseif (isset($_GET['e'])) {

          require_once __DIR__ . '/__includes/edit.php';

        } elseif (isset($_POST['search'])) {

          $q = htmlentities(strip_tags($_POST['search']));
          $clear_search_btn = '<a href="" id="csearch">
                                <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                                  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
                                </svg>
                               </a>';
          require_once __DIR__ . '/__includes/home.php';
          require_once __DIR__ . '/__includes/search.php';
          require_once __DIR__ . '/__includes/contact.php';
          
        } else {

          require_once __DIR__ . '/__includes/home.php';
          require_once __DIR__ . '/__includes/articles.php';
          require_once __DIR__ . '/__includes/contact.php';

        }

        if ($user_loggedin == true) {

          require __DIR__ . '/__includes/modals.php';
          
        }
      ?>
    </div>
  </div>

  <?php require_once __DIR__ . '/__includes/footer.php' ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
