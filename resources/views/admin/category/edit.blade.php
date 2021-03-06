@extends('layouts.admin')
@section('content')
@section('name', 'SỬA SẢN PHẨM')
<section class="content">
<form action="{{route('category.update',['id' => $data->id])}}" method="post" accept-charset="utf-8">
		{{method_field('PUT')}}
		{{csrf_field()}}
		<div class="row" style="margin: auto;">
			<div class="col-sm-4 col-xs-12"></div>
			<div class="col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Name</label>
					<input class="form-control input-md" type="text" value="{{$data->name}}" name="name" placeholder="tên danh mục">
					@if(count($errors) > 0)
			<small style="color: red">{{$errors->first('name')}}</small>
			@endif
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success">Cap nhat</button>
				</div>
			</div>
			
		</div>


	</form>


</section>

@endsection