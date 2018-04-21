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
                    <img src="{{$item->getImage()}}" class="img-thumbnail" width="100px" height="100px">
                  </td>
                  <td>{{$item->category->name}}</td>
                  <td>{{$item->user->name}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>
                    <a href="" class="btn btn-xs btn-danger button-delete">Delete</a>
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
      var id = $( "#divdetele" ).data('id');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: "{{url('admin/product')}}/"+id,
        type: 'DELETE',
        asyc:true,
        success : function (result){
         if (result =='true') {
          $( "#divdetele" ).data('id', id).remove();
        }
      }
    })

    });


  });
</script>
@endsection