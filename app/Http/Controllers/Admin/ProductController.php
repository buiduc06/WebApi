<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
 
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $getdata = Product::all();
        return view('admin.product.index', compact('getdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listcate = Category::all();
        if (count($listcate)<=0) {
        return redirect(route('category.create'))->with('msg', 'hiện chưa có danh mục nào mời bạn tạo danh mục trước');
        }
        return view('admin.product.create', compact('listcate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'image' =>'nullable|image'
        ],[
            'name.required'=>'vui long nhap name choa product',
            'image.image' =>'dinh dang anh khong dung',
        ]);

        $sendData = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $photoname = str_slug($request->name, '-') . '-' . rand(1000, 10000) . '.' . $request->image->getClientOriginalExtension();
            $file->move(public_path('images/'), $photoname);
        }

        $sendData['image'] = $photoname;
        $sendData['user_id'] = Auth::id();
        $sendData['status'] = $request->status;
        $sendData['slug'] = str_slug($request->name,'-'); 

        Product::create($sendData);

        return redirect(route('product.index'))->with('msg', 'tao san pham thanh cong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_numeric($id)) {
            $data = Product::findOrFail($id);
            $listcate = Category::all();
            return view('admin.product.edit', compact('data', 'listcate'));
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'name' => 'required',
            'image' =>'nullable|image'
        ],[
            'name.required'=>'vui long nhap name choa product',
            'image.image' =>'dinh dang anh khong dung',
        ]);

        $sendData = $request->all();
        if ( $checkProduct = Product::findOrFail($id)) {
         
            if ($request->hasFile('image')) {
                $file = $request->image;
                $photoname = str_slug($request->name, '-') . '-' . rand(1000, 10000) . '.' . $request->image->getClientOriginalExtension();
                $file->move(public_path('images/'), $photoname);
                 
            }
            $checkProduct->name = $request->name;
            $checkProduct->description = $request->description;
            $checkProduct->image = isset($photoname) ?$photoname :$checkProduct->image;
            $checkProduct->user_id = Auth::id();
            $checkProduct->meta = $request->meta !=null ?$request->meta:'';
            $checkProduct->github = $request->github !=null ?$request->github:'';
            $checkProduct->status = $request->status;
            $checkProduct->summary = $request->summary;
            $checkProduct->demolink = $request->demolink;
            $checkProduct->slug = str_slug($request->name,'-');  
            $checkProduct->update();

            return redirect(route('product.index'))->with('msg', 'cap nhat san pham thanh cong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkProduct = Product::findOrFail($id);
        $checkProduct->delete();
        return 'true';
    }
}
