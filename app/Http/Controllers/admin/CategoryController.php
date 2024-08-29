<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request){

        $categories = Category::latest();

        if(!empty($request->get('keyword'))){
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');
        }

        $categories = $categories->paginate(10);
        return view('admin.category.list',compact('categories'));
    }


    public function create(){
        return view("admin.category.create");
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'slug' => 'required|unique:categories',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $request->session()->flash('success', 'Category added successfully');

            return response()->json([
                'status' => true,
                'errors' => 'Category added successfully'
            ]);
            
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function edit(){

    }

    public function update(){

    }



}
