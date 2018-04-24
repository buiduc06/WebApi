   @if(isset($data) && !empty($data) &&count($data)>0)
<div class="items-wrapper isotope row">

  @foreach($data as $item)
 
  <div class="item col-lg-3 col-6" style="cursor: pointer;">
   <div class="item-inner animated flipInX">
    <figure class="figure">
     <img class="ducpanda-img"  src="{{$item->getImage()}}"/>
   </figure>
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
