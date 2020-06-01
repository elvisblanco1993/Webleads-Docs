<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron jumbotron-fluid support-banner">
        <h1 class="text-center">Have a specific question?</h1>
        <p class="lead text-center">Fill in this form to open a support request. We will get back to you soon.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <form method='POST' id='contact_form'>
        <input type='hidden' name='recaptcha_response' id='g-recaptcha'>
        <input type='text' name='refcode' value='go6ja5hlt7231f4gien8uysmz9wpvk0cbxdr' hidden='true'>
        <input type='text' name='domain' value='help.webleads.app' hidden='true'>
        <input type='text' name='owner' value='259' hidden='true'>
        <input type='text' name='audience_id' value='10092' hidden='true'>
        <input type='text' name='returnurl' value='https://help.webleads.app/contact.php' hidden='true'>
        <input type='text' name='source' value='10092' hidden='true'>

        <div class="form-group">
          <label for="fname" class="mb-0">First Name <span class="text-danger">*</span></label>
          <input class="form-control" id='fname' type='text' name='fname' placeholder='Peter' required>
        </div>
        <div class="form-group">
          <label for="lname" class="mb-0">Last Name <span class="text-danger">*</span></label>
          <input class="form-control" id='lname' type='text' name='lname' placeholder='Johns' required>
        </div>
        <div class="form-group">
          <label for="email" class="mb-0">Email associated with account <span class="text-danger">*</span></label>
          <input class="form-control" id='email' type='email' name='email' placeholder='pjohns@email.com' required>
        </div>
        <div class="form-group">
          <label for="tel" class="mb-0">Contact phone</label>
          <input class="form-control" id='tel' type='tel' name='tel' placeholder='123 456 7890'>
        </div>
        <div class="form-group">
          <label for="interest" class="mb-0">Subject <span class="text-danger">*</span></label>
          <input class="form-control" id='interest' type='text' name='interest[]' placeholder='' required>
        </div>
        <div class="form-group">
          <label for="message" class="mb-0">Description</label>
          <textarea class="form-control" id='message' name='message' placeholder='Write something here...'></textarea>
        </div>
        <div class="form-group text-right">
          <button class="btn btn-success" type='submit' id='submit' name='SMBT'>Send request</button>
        </div>
        <div class="form-group">
          <span id='status_msg'></span>
        </div>
      </form>
    </div>
  </div>
</div>
