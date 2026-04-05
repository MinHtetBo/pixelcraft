<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $product = Product::select('id', 'name', 'image', 'stock', 'created_at')->paginate(4);
        return view('admin.product.list', compact('product'));
    }

    //product create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //product delete page
    public function delete($id)
    {

        $deleteImage = Product::find($id);
        $deleteImage = $deleteImage['image'];

        if (file_exists(public_path('productImage/' . $deleteImage))) {
            unlink(public_path('productImage/' . $deleteImage));
        }
        Product::destroy($id);

        return to_route('product#list');
    }

    //product edit
    public function edit($id)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $product = Product::find($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    //product update
    public function update(Request $request, $id)
    {
        $request['id'] = $id;

        $this->productValidation($request, 'update');
        $updateData = $this->getProuductData($request);

        if ($request->hasFile('image')) {

            // old image delete -> new image store -> new image name update in db
            $oldImage = $request['oldImageName'];

            if (file_exists(public_path('productImage/' . $oldImage))) {
                unlink(public_path('productImage/' . $oldImage));
            }

            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('productImage/'), $newImage);

            $updateData['image'] = $newImage;
        }

        Product::find($id)->update($updateData);

        return to_route('product#list');
    }

    //get productData
    private function getProuductData($request)
    {
        return  [
            'name' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'stock' => $request->stock,
        ];
    }

    //product create
    public function create(Request $request)
    {
        $this->productValidation($request, 'create');

        $data = $this->getProuductData($request);

        $file = $request->image;

        $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

        $file->move(public_path('productImage/'), $imageName);

        $data['image'] = $imageName;

        Product::create($data);

        return back()->with(['success' => 'create successfully']);
    }

    //validation check
    private function productValidation($request, $action)
    {
        $rule = [
            'price' => 'required|min:2|integer',
            'description' => 'required|min:10',
            'title' => 'required|min:2|max:100|unique:products,name,' . $request->id,
            'categoryId' => 'required',
            'stock' => 'required'
        ];

        $rule['image'] = $action == 'create' ? 'required|mimes:jpeg,png,webp,gif,jpg,svg' : '|mimes:jpeg,png,webp,gif,jpg,svg';

        $request->validate($rule);
    }
}
