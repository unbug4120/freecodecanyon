<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use DB;

class PostController extends Controller
{
    public function index($category, $url, $id)
    {
        $posts = DB::table('posts')
            ->selectRaw('posts.title , posts.created_at, posts.slug, posts.content, posts.download_content, posts.demo, posts.thumb, posts.description, posts.cate_id, categories.slug AS cate_slug')
            ->join('categories', 'posts.cate_id', '=', 'categories.id')->where('posts.id', $id)->first();
        $posts_related = DB::table('posts')
            ->selectRaw('posts.title , posts.created_at, posts.slug, posts.content, posts.download_content, posts.demo, posts.thumb, posts.description, posts.cate_id, categories.slug AS cate_slug')
            ->join('categories', 'posts.cate_id', '=', 'categories.id')->where('cate_id', $posts->cate_id)->inRandomOrder()->take(8)->get();
        $count_script = Post::select('*')->where('cate_id', 1)->count();
        $count_app = Post::select('*')->where('cate_id', 2)->count();
        $count_plugin = Post::select('*')->where('cate_id', 3)->count();
        $count_cms = Post::select('*')->where('cate_id', 4)->count();
        $category = Category::select('*')->where('id', $posts->cate_id)->first();
        return view('post', compact(['posts', 'count_script', 'count_app', 'count_plugin', 'count_cms', 'category', 'posts_related']));
    }
}
