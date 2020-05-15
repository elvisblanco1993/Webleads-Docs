<?php
  if (isset($_GET['a']) && is_numeric($_GET['a'])) {
    $a = $_GET['a'];
  } else {
    header("Location: /");
  }
?>

<main class="col mt-md-5 mt-3" role="main">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="mb-md-5 mb-3">
          <a class="text-dark" href="/">
            <svg class="bi bi-arrow-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 010 .708L3.207 8l2.647 2.646a.5.5 0 01-.708.708l-3-3a.5.5 0 010-.708l3-3a.5.5 0 01.708 0z" clip-rule="evenodd"/>
              <path fill-rule="evenodd" d="M2.5 8a.5.5 0 01.5-.5h10.5a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
            </svg>
            Home
          </a>
        </div>

        <div class="content-table-title d-none d-sm-block">
          Table of contents
        </div>
        <div class="list-group p-0 content-table d-none d-sm-flex">
          <?php echo retrieve_articles_list($db); ?>
        </div>

      </div>
      <div class="col-md-7 w-100">
        <h2 class="m-0">
          <?php echo retrieve_single_article($db, $a)[1]?>
        </h2>
        <small>Last updated: <?php echo retrieve_single_article($db, $a)[0] ?></small>
        <div class="contents mt-3">
          <?php echo $parse->text(retrieve_single_article($db, $a)[2])?>
        </div>
      </div>

      <?php if ($user_loggedin == true): ?>
      <div class="col-md-2">
        <p>Article options</p>
        <a class="text-secondary article-option" href="?e=<?php echo $a;?>">
          <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
          </svg>
          Edit
        </a>
        <br>
        <a class="text-danger article-option" href="" data-toggle='modal' data-target='#delete'>
          <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
          </svg>
          Delete
        </a>
      </div>
    <?php endif; ?>

    </div>
  </div>
</main>
