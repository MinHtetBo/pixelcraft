<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // category list page

    public function list(){
        $categories = Category::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')->paginate(6);

        $categoryCount = $categories->toArray();
        $categoryCount = count($categoryCount['data']);

        return view('admin.category.list', compact('categories', 'categoryCount'));
    }

    //create category
    public function create(Request $request){
       $this->validationCheck($request);

       Category::create(['name'=> $request->categoryName]);
       return back()->with(['success'=>'create successfully']);
    }

    //delete category
    public function delete($id){
      Category::destroy($id);
      return back();
    }

    //edit category
    public function edit($id){
        $category = Category::find($id);
      return view('admin.category.edit',compact('category'));
    }

     //update category
    public function update($id, Request $request){
        $request['id'] = $id;
        $this->validationCheck($request);
        Category::where('id', $id)->update([
            'name' => $request->categoryName
        ]);
        return back()->with(['updateSuccess' => 'Update successfully...']);
    }

    //validation check for category
    private function validationCheck($request){
        $request->validate([
        'categoryName'=>'required|min:2|max:30|unique:categories,name,'. $request->id
       ]);
    }

}
