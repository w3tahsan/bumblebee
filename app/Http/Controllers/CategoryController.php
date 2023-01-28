<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('admin.category.category', [
            'categories'=>$categories,
        ]);
    }
    function category_store(Request $request){

        $request->validate([
            'category_name'=>'required|unique:categories',
            'cat_image'=>'required',
            'cat_image'=>'mimes:png,jpg',
            'cat_image'=>'file|max:512',
        ]);

        $category_id = Category::insertGetId([
            'category_name'=>$request->category_name,
            'created_at'=>Carbon::now(),
        ]);


        $uploaded_file = $request->cat_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.rand(1000000000,9999999999).'.'.$extension;
        Image::make($uploaded_file)->resize(250, 200)->save(public_path('/uploads/category/'.$file_name));
        Category::find($category_id)->update([
            'cat_image'=>$file_name,
        ]);
        return back();
    }


    function category_delete($category_id){

        $post = Post::where('category_id', $category_id)->get();

        foreach ($post as $post) {
            Post::find($post->id)->update([
                'category_id' => 11,
            ]);
        }

        $category_photo = Category::where('id', $category_id)->first()->cat_image;
        $delete_from = public_path('uploads/category/'.$category_photo);
        unlink($delete_from);

        Category::find($category_id)->delete();
        return back()->withSuccess('Category Deleted Successfully!');
    }

    function category_edit($category_id){
        $category = Category::find($category_id);
        return view('admin.category.edit', [
            'category'=>$category,
        ]);
    }
    function category_update(Request $request){
        if($request->cat_image == ''){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
            ]);
            return back();
        }
        else{
            $category_photo = Category::where('id', $request->category_id)->first()->cat_image;
            $delete_from = public_path('uploads/category/'.$category_photo);
            unlink($delete_from);

            $uploaded_file = $request->cat_image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.rand(1000000000,9999999999).'.'.$extension;
            Image::make($uploaded_file)->resize(250, 200)->save(public_path('/uploads/category/'.$file_name));

            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'cat_image'=>$file_name,
            ]);
            return back();
        }
    }
}
