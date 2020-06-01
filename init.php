<?php
  require __DIR__ . '/server/auth.php';
  require __DIR__ . '/libs/Parsedown.php';
  require __DIR__ . '/libs/ParsedownExtra.php';
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
