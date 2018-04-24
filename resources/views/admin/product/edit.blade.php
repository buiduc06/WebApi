@extends('layouts.admin')
@section('content')
<section class="content" style="min-height: 1000px">

	<form action="{{route('product.update',['id'=>$data->id])}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		{{csrf_field()}}
		{{method_field('PUT')}}
		<div class="row col-sm-12" style="margin: auto;">
			<div class="col-sm-9 col-xs-12">
				<div class="form-group">
					<label>Tên Sản Phẩm </label>
					<input class="form-control input-md" type="text" name="name" placeholder="tên danh mục" value="{{$data->name}}" style="max-width: 70%"> 
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('name')}}</small>
					@endif
				</div>
				<br>
				<div class="form-group">
					<label>Công Nghệ Sử dụng </label>
					<input class="form-control input-md" type="text" name="meta" placeholder="tên meta" value="{{$data->meta}}" style="max-width: 70%">
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('meta')}}</small>
					@endif
				</div>
				<br>
				

				<div class="form-group">
					<label>Mô Tả Ngắn </label>
					<br>
					<textarea name="summary" style="min-width: 70%;min-height: 100px">
						{{$data->summary}}
					</textarea>
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('summary')}}</small>
					@endif
				</div>
				<br>

				<div class="form-group">
					<label>Chi Tiết</label>
					<textarea id="editor1" name="description" rows="10" cols="80">
						{{$data->description}}
					</textarea>
				</div>
				
			</div>


			<div class="col-sm-3 col-xs-12">
					<div class="form-group">
						<p><B>DANH MUC</B></p>
						@foreach($listcate as $list)
						<label>
							<input type="checkbox" name="category_id[]" value="{{$list->id}}"
							@if(!empty($data->category->find($list->id)))
							checked 
							@endif
							>
							{{$list->name}}
						</label><br>
						@endforeach
					</div>
					<div class="form-group">
						<label>Ứng Dụng</label>
						<select name="status" class="form-control input-md">
							@foreach($data->getAppAll() as $key =>$value)	
						 <option value="{{$key}}" {{ $data->status==$key ? 'selected':''}}>{{$value}}</option>
						 @endforeach
						</select>
					</div>
					<br>
					<div class="form-group">
						<label>Link Resource </label>
						<input class="form-control input-md" type="text" name="github" placeholder="ex: https://github.com/buiduc06" value="{{$data->github}}">
						@if(count($errors) > 0)
						<small style="color: red">{{$errors->first('github')}}</small>
						@endif
					</div>
					<br>
					<div class="form-group">
						<label>Link Demo </label>
						<input class="form-control input-md" type="text" name="demolink" placeholder="https://ducpanda.com/sanpham/1" value="{{$data->demolink}}">
						@if(count($errors) > 0)
						<small style="color: red">{{$errors->first('github')}}</small>
						@endif
					</div>

					<div class="form-group">
						<label>Hình Ảnh</label>
						<input type="file" name="image" style="margin-bottom: 10px;" onchange="readURL(this);">
						<img id="result-img" src="{{$data->getImage()}}" class="img-thumbnail"> 
						@if(count($errors) > 0)
						<small style="color: red">{{$errors->first('image')}}</small>
						@endif
					</div>


				</div>
				<div class="form-group col-sm-12">
					<button type="submit" class="btn btn-success">Cập Nhật Sản Phẩm</button>
				</div>

			</div>


		</form>

	</section>

	@endsection
	@section('js')
	<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#result-img')
					.attr('src', e.target.result);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
	<script>
		$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})
		$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})
</script>

</section>

@endsection