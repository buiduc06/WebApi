@extends('layouts.admin')
@section('name', 'DANH MỤC')
@section('linkpart', route('category.create'))
@section('content')
<section class="content">
 <div class="box">
  <div id="wait" style="display:none;width:69px;height:89px;z-index: 1000;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{asset('images/demo_wait.gif')}}' width="64" height="64" /><br>Loading..</div>
  <div class="box-body">
    <table id="tabledata" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>name</th>
          <th>Total Product</th>
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
          <td>{{$item->getTotalProduct()}}</td>
          <td>{{$item->created_at}}</td>
          <td>
            <a type="button" class="btn btn-danger btn-xs button-delete"></i>Delete</a>
            <a href="{{route('category.edit',['id'=>$item->id])}}" class="btn btn-primary btn-xs button-edit">Edit</a>
          </td>
        </tr>
        @endforeach
        @else
        {{-- <h4 class="text-danger">Không có dữ liệu</h4> --}}
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
        url: "{{url('admin/category')}}/"+id,
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

