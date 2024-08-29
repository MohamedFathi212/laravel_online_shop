<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){

    }


    public function create(){
        return view("admin.category.create");
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'slug' => 'required|unique:categories',
        ]);

        if ($validator->passes()){
            $category =  new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();
            $request->session()->flash('success','Category added succ');
            return response()->json([
                'status' => true,
                'message' =>'Category Added Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' =>$validator->errors()
            ]);
        }

    }

    public function edit(){

    }

    public function update(){

    }



}



