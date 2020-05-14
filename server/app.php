<?php

// Saving an article
if (isset($_POST['save_article'])) {
  $d = date('Y-m-d');
  $t = $_POST['title'];
  $c = $_POST['contents'];

  if (create_article($db, $d, $t, $c)) {
    header("Location: /?created=1");
  } else  {
    header("Location: /?created=0");
  }
}

// Updating an article
if (isset($_POST['update_article'])) {
  $d = date('Y-m-d');
  $id = $_POST['id'];
  $t = $_POST['title'];
  $c = $_POST['contents'];

  if (update_article($db, $id, $d, $t, $c)) {
    header("Location: ?a=$id&updated=1");
  } else  {
    header("Location: ?a=$id&updated=0");
  }
}

// Updating an article
if (isset($_POST['delete_article'])) {
  $id = $_POST['id'];

  if (delete_article($db, $id)) {
    header("Location: /?delete=1");
  } else  {
    header("Location: /?delete=0");
  }
}
