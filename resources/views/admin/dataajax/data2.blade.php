<style type="text/css" media="screen">
#imgproduct .img-show{
  background:url({{$data->getImage()}}) no-repeat;
  background-size:100%;
  display:block;
  text-align: center;
  padding-top: 20px;
  width:380px;
  height:400px;
  -webkit-transition: background-position 3s ease-in-out;
  -moz-transition: background-position 3s ease-in-out;
  -ms-transition: background-position 3s ease-in-out;
  -o-transition: background-position 3s ease-in-out;
  transition: background-position 3s ease-in-out;
  box-shadow: 1px 3px 20px 5px rgba( 1,2,2,0.05);
}

#imgproduct .img-show:hover {
  background-position:0px 100%;

}
.detail-pj{
padding-right: 10em;padding-left: 2vw;padding-top: 4vw
}
.row-detail{
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
@media only screen and (max-width: 480px) and (min-width: 320px){
  #imgproduct .img-show{
    display:block;
    padding-top: 20px;
    height:200px;
    width: 100%;
    box-shadow: 1px 3px 20px 5px rgba( 1,2,2,0.05);

  }
  .detail-pj{
  padding: 0;
}
.row-detail{ 
}
.theme-image{
  padding: 0;
}
}
</style>
<div class="ducpanda-intro container-fluid">
  <div class="container row-detail" style="margin: auto;">
    <div class="col-md-7 col-xs-12 detail-pj">
      <h2><b class="display-4" style="font-size: 1.5vw">PROJECT</b> 
        <span style="font-size: 5.3vw">{{$data->name}}</span>
      </h2>
      <div class="desc" style="font-size: 1vw">
        {{$data->summary}}
      </div>
      <div class="other-info clearfix">
        <span class="rating center-block" style="margin-top: 1vw">
          <img src="images/5-star.png" />
        </span>
      </div>
      <div class="theme-action" style="margin-top: 1vw">
        <a href="{{$data->github!=null ?$data->github:'https://github.com/buiduc06'}}" target="_blank" class="btn btn-success">View Resource</a>
        <a 
        @if(!empty($data->demolink))
        href="{{$data->demolink}}" target="_blank"  
        @else
        href="##" onclick="alert('Xin lỗi link project này đã bị hỏng hoặc ko có vui lòng liên hệ QTV để sửa lại')" 
        @endif
        class="btn btn-outline-primary">Demo</a>
      </div>
    </div>

    <div class="col-md-5 col-xs-12 theme-image" style="margin-top: 20px">
      <div id="imgproduct">
       <a class="img-show"></a>
     </div>

   </div>
 </div>
 <br><br>
 <div class="container row" style="margin: auto;">
  <div class="col-md-8">
    <h4 style="font-size: 1.3vw;padding-bottom: 1vw">TÍNH NĂNG NỔI BẬT</h4>
    {!!$data->description!!}
  </div>

  <div class="col-md-4">
   <h5 style="font-size: 1.3vw;border-bottom: 2px solid #1ca4dd;padding-bottom: 1vw;width: 80%">CÔNG NGHỆ SỬ DỤNG</h5>
   @php
   $arr = explode('|', $data->meta);
   for ($i=0; $i <sizeof($arr) ; $i++) { 
    echo "<li>$arr[$i]</li>";
  }
  @endphp
  {{-- <li>{!!$data->meta!!}</li> --}}
</div>
</div>
</div>
