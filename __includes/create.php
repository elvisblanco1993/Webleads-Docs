<?php if ($user_loggedin == true): ?>
  <main class="col mt-5" role="main">
    <div class="container">
      <div class="row">
        <div class="col">
          <h3>New article</h3>
          <form method="post">
            <div class="form-group">
              <input type="text" name="title" class="form-control col-md-3" placeholder="Title">
            </div>
            <div class="form-group">
              <textarea class="form-control" name="contents" cols="30" rows="10"></textarea>
              <small class="text-muted">Supports markdown.</small>
            </div>
            <div class="form-group">
              <input type="submit" value="Save" name="save_article" class="btn btn-outline-primary">
              <a class="btn btn-light ml-2" href="/">Discard</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
<?php else: ?>
  <?php header("Location: /"); ?>
<?php endif; ?>
