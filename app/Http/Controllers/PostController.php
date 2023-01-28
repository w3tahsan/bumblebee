<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

class PostController extends Controller
{
    function add_post(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.add_post', [
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }

    function post_store(Request $request){
        $after_emplode_tag = implode(',', $request->tag_id);
        $post_id = Post::insertGetId([
            'author_id'=>Auth::id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'short_desp'=>$request->short_desp,
            'desp'=>$request->desp,
            'tag_id'=>$after_emplode_tag,
            'feat_image'=>$request->feat_image,
            'slug'=>Str::lower(str_replace(' ', '-', $request->title)).'-'.rand(1000000000,9999999999),
            'created_at'=>Carbon::now(),
        ]);

        $uploaded_file = $request->feat_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', Auth::user()->name)).'-'.rand(1000000000,9999999999).'.'.$extension;

        Image::make($uploaded_file)->save(public_path('uploads/post/'.$file_name));

        $update = Post::find($post_id)->update([
            'feat_image'=>$file_name,
        ]);
        return back();
    }


    function my_post(){
        $mypost = Post::where('author_id', Auth::id())->get();
        return view('admin.post.post', [
            'mypost'=>$mypost,
        ]);
    }

    function post_view($post_id){
        $post = Post::find($post_id);
        return view('admin.post.view_post',[
            'post'=>$post,
        ]);
    }

    function post_delete($post_id){
        $post_imge = Post::find($post_id);
        $delete_from = public_path('uploads/post/'.$post_imge->feat_image);
        unlink($delete_from);
        Post::find($post_id)->delete();
    }

    function post_edit($post_id){
        $categories = Category::all();
        $tags_main = Tag::all();
        $post_info = Post::find($post_id);
        return view('admin.post.edit',[
            'categories'=>$categories,
            'tags_main'=>$tags_main,
            'post_info'=>$post_info,
        ]);
    }

    function post_update(Request $request){
        $after_emplode_tag = implode(',', $request->tag_id);

        if($request->feat_image ==''){
            Post::find($request->post_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'tag_id'=>$after_emplode_tag,
                'short_desp'=>$request->short_desp,
                'desp'=>$request->desp,
            ]);
        }
        else{
            $post_imge = Post::find($request->post_id);
            $delete_from = public_path('uploads/post/'.$post_imge->feat_image);
            unlink($delete_from);

            $uploaded_file = $request->feat_image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(Auth::user()->name).'-'.rand(1000000000,9999999999).'.'.$extension;

            Image::make($uploaded_file)->save(public_path('uploads/post/'.$file_name));

            Post::find($request->post_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'tag_id'=>$after_emplode_tag,
                'short_desp'=>$request->short_desp,
                'desp'=>$request->desp,
                'feat_image'=>$file_name,
            ]);

            return back();


        }
    }
}
