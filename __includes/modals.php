
<!-- Modal -->
<div class='modal fade' id='delete' tabindex='-1' role='dialog' aria-labelledby='delete' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class="modal-body">
        <div class="media">
          <svg class="bi bi-exclamation-triangle mr-3 text-danger" width="6em" height="6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 00-.054.057L1.027 13.74a.176.176 0 00-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 00.066-.017.163.163 0 00.055-.06.176.176 0 00-.003-.183L8.12 2.073a.146.146 0 00-.054-.057A.13.13 0 008.002 2a.13.13 0 00-.064.016zm1.044-.45a1.13 1.13 0 00-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" clip-rule="evenodd"/>
            <path d="M7.002 12a1 1 0 112 0 1 1 0 01-2 0zM7.1 5.995a.905.905 0 111.8 0l-.35 3.507a.552.552 0 01-1.1 0L7.1 5.995z"/>
          </svg>
          <div class="media-body">
            <p class="lead mt-0 mb-0"><strong>Are you sure you want to delete this article?</strong></p>
            <span class="article-option">When you delete this article, it will be lost forever.</span>
          </div>
        </div>
      </div>
      <div class="modal-footer pt-0 pb-0">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        <form class="m-0" method="post">
          <input type="text" name="id" value="<?php echo $a ?>" hidden="true">
          <div class="form-group m-1">
            <input class="btn btn-danger" type="submit" name="delete_article" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>