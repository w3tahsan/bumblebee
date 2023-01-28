<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\PopularPost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function welcome()
    {
        $slider_post = Post::latest('created_at')->take(3)->get();
        $recent_post = Post::latest('created_at')->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();

        $popular_posts = PopularPost::groupBy('post_id')
            ->selectRaw('post_id, sum(total_view) as sum')
            ->orderBy('sum','DESC')
            ->get();

        return view('frontend.index', [
            'slider_post' => $slider_post,
            'categories' => $categories,
            'recent_post' => $recent_post,
            'tags' => $tags,
            'popular_posts' => $popular_posts,
        ]);
    }

    function catgory_post($category_id)
    {
        $category_posts = Post::where('category_id', $category_id)->get();
        $category_info = Category::find($category_id);
        return view('frontend.category_post', [
            'category_posts' => $category_posts,
            'category_info' => $category_info,
        ]);
    }
    function author_post($author_id)
    {
        $tags = Tag::all();
        $categories_info = Post::where('author_id', $author_id)->get();
        $author_posts = Post::where('author_id', $author_id)->get();
        $author_info = User::find($author_id);
        return view('frontend.author_post', [
            'author_posts' => $author_posts,
            'author_info' => $author_info,
            'categories_info' => $categories_info,
            'tags' => $tags,
        ]);
    }

    function author_list()
    {
        $authorlists = Post::select('author_id')
            ->groupBy('author_id')
            ->selectRaw('author_id, sum(author_id) as sum')
            ->get();
        return view('frontend.author_list', [
            'authorlists' => $authorlists,
        ]);
    }

    function post_details($slug)
    {


        $post_details = Post::where('slug', $slug)->get();

        $ip = getHostByName(getHostName());

        if(PopularPost::where('post_id', $post_details->first()->id)->exists()){
            PopularPost::where('post_id', $post_details->first()->id)->increment('total_view', 1);
        }
        else{
            PopularPost::insert([
                'post_id' => $post_details->first()->id,
                'total_view' => 1,
                'created_at' => Carbon::now(),
            ]);
        }

        $comments = Comment::with('replies')->where('post_id', $post_details->first()->id)->whereNull('parent_id')->get();
        return view('frontend.post_details', [
            'post_details' => $post_details,
            'comments' => $comments,
        ]);
    }

    function search(Request $request){
        $data = $request->all();

        $searched_post = Post::where(function ($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('title', 'like','%'.$data['q'].'%');
                    $q->orWhere('desp', 'like','%'.$data['q'].'%');
                });
            }
        })->Paginate(3);

        $categories = Category::all();
        $tags = Tag::all();
        return view('frontend.search',[
            'categories'=> $categories,
            'tags'=> $tags,
            'searched_post'=> $searched_post,
        ]);
    }
}
