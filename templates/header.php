<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="assets/img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      Help Center
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>
        <li class="nav-item">
          <?php echo $auth_btn; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
