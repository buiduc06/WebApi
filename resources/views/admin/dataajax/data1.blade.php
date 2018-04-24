
@if(isset($data) && !empty($data) &&count($data)>0)
<style type="text/css" media="screen">
#imgproduct .img-thumb{
  display:block;
  padding-top: 20px;
  width:240px;
  height:150px;
  box-shadow: 1px 3px 20px 5px rgba( 1,2,2,0.05);

}

</style>
<div class="items-wrapper isotope row">

  @foreach($data as $item)
  
  
  <div class="item col-lg-3 col-6 animated flipInX" id="imgproduct" style="cursor: pointer;">
   <a data-id="{{$item->id}}" class="myproduct-button figure imgproduct img-thumb" style="background:url({{$item->getImage()}}) no-repeat;
   background-size:100%;">
   {{-- <a class="img-thumb"></a> --}}
 </a>
 <div class="item-inner">

   <div class="content text-left">
     <h3 class="sub-title"><a href="#">{{ $item->name}}</a></h3>
     <div class="meta">{{ $item->meta !=null ?$item->meta:''}}</div>
     <div class="action"><a href="{{ $item->github !=null ?$item->github:'https://github.com/buiduc06'}}" target="_blank">View on Github</a></div>
   </div><!--//content-->    
   <a class="link-mask myproduct-button" data-id="{{$item->id}}"></a>              
 </div><!--//item-inner-->
</div><!--//item-->

@endforeach

</div><!--//item-wrapper-->

@else
<h4 class="text-danger text-center display-4" style="font-size: 16px;">Không Có dữ Liệu</h4>
@endif
