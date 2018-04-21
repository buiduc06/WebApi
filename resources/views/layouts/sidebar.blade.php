
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>ADMIN</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{Request::path() =="admin" ?'active':''}} treeview">
        <a href="#" onclick="window.location.href='{{route('admin.index')}}'"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
       <li class="treeview {{Request::path() =="admin/category" ?'active':''}}">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Danh Mục</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">{{App\Category::count()}}</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> Danh sách danh mục</a></li>
          <li><a href="{{route('category.create')}}"><i class="fa fa-circle-o"></i> Tạo danh mục</a></li>
        </ul>
      </li>

      <li class="treeview {{Request::path() =="admin/product" ?'active':''}}">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Sản Phẩm</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">{{App\Product::count()}}</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a></li>
          <li><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i> Tạo sản phẩm</a></li>
        </ul>
      </li>

      <li class="treeview {{Request::path() =="admin/listapp" ?'active':''}}">
        <a href="#" onclick="window.location.href='{{route('admin.listapp')}}'">
          <i class="fa fa-wifi"></i> <span>Danh Sách App</span>
        </a>
      </li>
 

    <li class="treeview {{Request::path() =="admin/setting" ?'active':''}}">
        <a href="#" onclick="window.location.href='{{route('admin.setting')}}'">
          <i class="fa fa-gears"></i> <span>Cài Đặt</span>
        </a>
      </li>
  
  </section>
  <!-- /.sidebar -->
</aside>
