@extends('layouts.admin')
@section('content')
@section('name', 'sản phẩm')
@section('linkpart', route('product.create'))
<section class="content">
 <div class="box">
  <div id="wait" style="display:none;width:69px;height:89px;z-index: 1000;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{asset('images/demo_wait.gif')}}' width="64" height="64" /><br>Loading..</div>

  <div class="box-body">
    <table id="tabledata" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>image</th>
          <th>category</th>
          <th>user</th>
          <th>APP</th>
          <th>created_at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if(isset($getdata) && !empty($getdata))
        @foreach($getdata as $item)
        <tr id="divdetele" data-id="{{$item->id}}">
          <td>{{$item->id}}</td>
          <td>{{$item->name}}</td>
          <td>
            <img src="{{$item->getImage()}}" class="img-thumbnail" style="width: 200px;
    height: 200px;
    object-fit: cover;">
          </td>
          <td>
            <ul>
              @foreach($item->category as $category)
              <li>{{$category->name}}</li>
              @endforeach
            </ul>


          </td>
          <td>{{$item->user->name}}</td>
          <td>{{$item->getAppName()}}</td>
          <td>{{$item->created_at}}</td>

          <td>
            <a href="#" class="btn btn-xs btn-danger button-delete" data-id="{{$item->id}}">Delete</a>
            <a href="{{route('product.edit',['id'=>$item->id])}}" class="btn btn-xs btn-primary">Edit</a>
          </td>
        </tr>
        @endforeach
        @else
        <h4 class="text-danger">Không có dữ liệu</h4>
        @endif
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
</section>
@endsection

@section('js')
<script>
  $(document).ready(function($) {
    $(document).ajaxStart(function(){
      $("#wait").css("display", "block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display", "none");
    });

    $( ".button-delete" ).on( "click", function() {
      if (!confirm("Do you want to delete")){
        return false;
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var id = $(this).data('id');

      $.ajax({
        url: "{{url('admin/product')}}/"+id,
        type: 'DELETE',
        success : function (result){
          $("#divdetele").data('id', id).remove();
        }
      })

    });


  });
</script>
@endsection