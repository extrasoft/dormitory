<div id="modalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title" style="font-size:20px;">
            <strong>ลบข้อมูลธนาคาร</strong>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" name="formDelete" action="bankDeleteQuery.php"
          enctype="multipart/form-data" method="post" onSubmit="JavaScript:return fncSubmit('formDelete');">
            <span id="delete1"></span>
          </form>
        </div><!-- End Panel panel-body-->
      </div><!-- End Panel panel-primary-->
    </div><!-- End Modal Content -->
  </div><!-- End Modal Dialog -->
</div><!-- End Modal -->
