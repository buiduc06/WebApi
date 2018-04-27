@extends('layouts.admin')
@section('content')
<section class="content" style="min-height: 1000px">

	<form action="{{route('product.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		{{csrf_field()}}

		<div class="row col-sm-12" style="margin: auto;">
			<div class="col-sm-9 col-xs-12">
				<div class="form-group">
					<label>Tên Sản Phẩm </label>
					<input class="form-control input-md" style="max-width: 70%;" type="text" name="name" placeholder="tên sản phẩm">
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('name')}}</small>
					@endif
				</div>
				<br>
				<div class="form-group">
					<label>Công Nghệ Sử Dụng </label>
					<input class="form-control input-md" style="max-width: 70%" type="text" name="meta" placeholder="NODEJS | ANGULAR">
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('meta')}}</small>
					@endif
				</div>
				<br>

				<div class="form-group">
					<label>Mô Tả Ngắn </label>
					{{-- <input class="form-control input-md" style="max-width: 70%" type="text" name="summary"  placeholder="tên summary"> --}}
					<br>
					<textarea name="summary" style="min-width: 70%;min-height: 100px"></textarea>
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('summary')}}</small>
					@endif
				</div>



				<br>
				<div class="form-group">
					<label>Chi tiết về sản phẩm</label>
					<textarea id="editor1" name="description" rows="10" cols="80">
					</textarea>

				</div>

			</div>

			<div class="col-sm-3 col-xs-12">
				<div class="form-group">
					<p><B>DANH MUC</B></p>
					@foreach($listcate as $list)
					<label>
						<input type="checkbox" name="category_id[]" value="{{$list->id}}">
						{{$list->name}}
					</label><br>
					@endforeach
				</div>

				<div class="form-group">
					<label>Ứng Dụng</label>
					<select name="status" class="form-control input-md">
						@php
						$check = New App\Product;
						foreach ($check->getAppAll() as $key => $value) {
							echo "<option value=".$key.">".$value."</option>";
						}
						@endphp

					</select>
				</div>

				<div class="form-group">
					<label>Link Resource </label>
					<input class="form-control input-md" type="text" name="github" placeholder="ex: https://github.com/buiduc06">
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('github')}}</small>
					@endif
				</div>

				<div class="form-group">
					<label>Link Demo </label>
					<input class="form-control input-md" type="text" name="demolink" placeholder="https://ducpanda.com/sanpham/1">
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('github')}}</small>
					@endif
				</div>
				<div class="form-group">
					<label>Hình Ảnh</label>
					<input type="file" name="image" style="margin-bottom: 10px;" onchange="readURL(this);">
					<img id="result-img" src="http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image" class="img-thumbnail"  style="width: 100%;
					height: 200px;
					object-fit: cover;"> 
					@if(count($errors) > 0)
					<small style="color: red">{{$errors->first('image')}}</small>
					@endif
				</div>


			</div>
			<div class="form-group col-sm-12">
				<br>
				<button type="submit" class="btn btn-success" >Tạo Sản Phẩm</button>
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

@endsection