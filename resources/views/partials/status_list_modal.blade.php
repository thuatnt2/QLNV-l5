
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form action="" method="POST">
      {{ csrf_field() }}
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class=" col-md-4 control-label">Tình trạng</label>
            <label class="radio-inline">
              <input type="radio" name="status" id="warning"  value="warning"> Chờ kết nối
            </label>
            <label class="radio-inline">
              <input type="radio" name="status" id="success" value="success"> Đã giao
            </label>
            <label class="radio-inline">
              <input type="radio" name="status" id="danger" value="danger"> Không có dữ liệu
            </label>
          </div>
          <div class="form-group">
            <label for="message-text" class=" col-md-4 control-label">Ghi chú</label>
            <textarea class="form-control" id="message-text" name="comment"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>