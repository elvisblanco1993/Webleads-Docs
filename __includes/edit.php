<?php
  if (isset($_GET['e']) && is_numeric($_GET['e'])) {
    $a = $_GET['e'];
  } else {
    header("Location: /");
  }
?>
<?php if ($user_loggedin == true): ?>
<main class="col mt-5" role="main">
  <div class="container">
    <div class="row">
      <div class="col">
        <form method="post">
          <input type="number" name="id" value="<?php echo $a; ?>" hidden="true">
          <div class="form-group">
            <input type="text" name="title" class="form-control col-md-3" placeholder="Title" value="<?php echo retrieve_single_article($db, $a)[1]; ?>">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="contents" cols="30" rows="10"><?php echo retrieve_single_article($db, $a)[2]; ?></textarea>
            <small class="text-muted">Supports markdown.</small>
            <br>
            <small class="text-muted"><strong>Tips</strong>: To add a single quote, instead add two, like ''</small>
          </div>
          <div class="form-group">
            <input type="submit" value="Save" name="update_article" class="btn btn-outline-primary">
            <a class="btn btn-light ml-2" href="?a=<?php echo $a; ?>">Discard</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php else: ?>
  <?php header("Location: /"); ?>
<?php endif; ?>
