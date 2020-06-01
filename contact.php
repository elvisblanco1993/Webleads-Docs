<?php require_once __DIR__ . '/init.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' code.jquery.com www.google.com gstatic.com cdn.jsdelivr.net stackpath.bootstrapcdn.com *.gstatic.com 'unsafe-inline';">
  <link rel="stylesheet" href="https://webleads.app/app/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/app.css">
  <title>Webleads Documentation and Support Center</title>
  <script src="https://www.google.com/recaptcha/api.js?render=6LfOOPoUAAAAAJKqOGkKFAuEI8qzoPBZ-vTDKG0C"></script>
  <script>
    grecaptcha.ready(function () {
      grecaptcha.execute("6LfOOPoUAAAAAJKqOGkKFAuEI8qzoPBZ-vTDKG0C", { action: "contact" }).then(function (token) {
        var recaptchaResponse = document.getElementById("g-recaptcha");
        recaptchaResponse.value = token;
      });
    });
  </script>
</head>
  <body>
    <?php
      require __DIR__ . '/templates/header.php';
      require __DIR__ . '/templates/contact.php';
      require __DIR__ . '/templates/footer.php';
     ?>
  </body>
  <script src="assets/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#contact_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
          url: 'https://webleads.app/api/contact/create.php',
          method: 'POST',
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $('#submit').attr('disabled', 'disabled');
          },
          success: function(data) {
            $('#submit').attr('disabled', false);
            if (data.success) {
              $('#contact_form')[0].reset();
              $('#status_msg').html("<div class='alert alert-success' role='alert'>Inquiry received! We will get back to you soon.</div>"); // Edit this line to change success message.
            } else {
              $('#status_msg').text(data.response);
            }
          }
        })
      });
    });
  </script>
</html>
