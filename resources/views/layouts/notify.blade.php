{{-- phần in ra thông báo chung --}}
@if(Session()->has('msg') || Session()->has('success'))

<script>
  $(document).ready(function () {
    $("#myModal").modal('show');
  })
</script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Thông Báo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if(Session()->has('msg'))
          <p>{{Session('msg')}}</p>
          @endif
          @if(Session()->has('success'))
          <p>{{Session('success')}}</p>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-confirm-answer no" data-dismiss="modal">close</button>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>

@endif

