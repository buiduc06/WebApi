<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\ProductCategory;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $getdata = Category::all();
        return view('admin.category.index', compact('getdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.category.create');
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
            'name' => 'required|unique:categories,name',
        ]);
        Category::create(['name' => $request->name ]);
        return redirect(route('category.index'))->with('msg', 'tạo danh mục thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = Category::findOrFail($id);
        // return view('admin.category.edit', compact('data'));
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
            $data = Category::findOrFail($id);
            return view('admin.category.edit', compact('data'));
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
    ]);
     Category::updateOrCreate(['id'=>$id],['name' => $request->name]);
     return redirect(route('category.index'))->with('msg', 'cập nhật danh mục thành công');
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkid = Category::find($id);
        if (!empty($checkid)) {
            $checkid->Product;

            foreach ($checkid->Product as $value) { // lấy ra id sản phẩm
                // nếu sản phẩm có từ 2 danh mục trở lên thì ko xóa sản phẩm đó
                if ((ProductCategory::where('product_id',$value->id)->count())<2) {
                    $value->delete();
                }
                // xoa thuoc tinh
                ProductCategory::where('category_id', $id)->delete();
            }
            $checkid->delete();
            return 'true';
        }
        return abort(404);

        // return redirect(route('category.index'))->with('msg', 'Xóa Danh Mục Và Sản phẩm Thành công');
    }
}
