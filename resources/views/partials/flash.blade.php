@if(Session::has('success') || Session::has('error') || Session::has('warning'))
<!-- Small modal -->
<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modalMessage">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    @if(Session::has('error'))
        <div class="modal-header modal-error">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Lỗi</h4>
        </div>
    @endif
        <div class="modal-body">
            <p>{{ Session::get('error') }}&hellip;</p>
        </div>
    </div> <!-- .modal-content -->
  </div> <!-- .modal-dialog -->
</div> <!-- .modal -->

@endif