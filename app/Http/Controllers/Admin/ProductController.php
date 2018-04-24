<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\ProductCategory;

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
            'image' =>'nullable|image',
            'category_id' =>'required'
        ],[
            'name.required'=>'vui long nhap name choa product',
            'image.image' =>'dinh dang anh khong dung',
            'category_id.required' =>'vui long chon danh muc',
        ]);

        $sendData = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $photoname = str_slug($request->name, '-') . '-' . rand(1000, 10000) . '.' . $request->image->getClientOriginalExtension();
            $file->move(public_path('images/'), $photoname);
        }

        $sendData['image'] = isset($photoname)?$photoname: null;
        $sendData['user_id'] = Auth::id();
        $sendData['status'] = $request->status;
        $sendData['slug'] = str_slug($request->name,'-'); 

        $returnProduct = Product::create($sendData);

        if (isset($request->category_id) && is_array($request->category_id)) {

            foreach ($request->category_id as $category_id) {
                ProductCategory::create([
                    'category_id' => $category_id,
                    'product_id' => $returnProduct->id,

                ]);
            }
        }

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

        if ( $checkProduct = Product::findOrFail($id)) {

            $slug = !empty(Product::where('id','!=', $id)->where('slug', $checkProduct->slug)->first()) ? str_slug($request->name,'-') : $checkProduct->slug ;

            if ($request->hasFile('image')) {
                $file = $request->image;
                $photoname = str_slug($request->name, '-') . '-' . rand(1000, 10000) . '.' . $request->image->getClientOriginalExtension();
                $file->move(public_path('images/'), $photoname);
            }
            $request->image = isset($photoname) ?$photoname :$checkProduct->image;
            $request->slug = $slug;
            $checkProduct->update($request->all());

            // check product_id in ProductCategory and delete

            if ($checkproduct = ProductCategory::find($id) ) {
             $checkproduct->delete();
         }
         if (isset($request->category_id) && is_array($request->category_id)) {
            foreach ($request->category_id as $category_id) {
                ProductCategory::create([
                    'category_id' => $category_id,
                    'product_id' => $id,

                ]);
            }
        }
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

        if ($checkProduct = Product::find($id)) {

// check xem co product trong bangtrung gian k
            if (ProductCategory::find($id)) {
                ProductCategory::where('product_id', $id)->delete(); // co thi xoa
            }
            $checkProduct->delete(); // xoa san pham
            return response()->json('true');
        }
        return abort(404);

    }
}
