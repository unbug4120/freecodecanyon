<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
        ->selectRaw('posts.title , posts.created_at, posts.slug, posts.thumb, posts.description, categories.slug AS cate_slug')
        ->join('categories', 'posts.cate_id', '=', 'categories.id')
        ->orderByDesc('posts.id')
        ->paginate(12);
        $count_script = Post::select('*')->where('cate_id', 1)->count();
        $count_app = Post::select('*')->where('cate_id', 2)->count();
        $count_plugin = Post::select('*')->where('cate_id', 3)->count();
        $count_cms = Post::select('*')->where('cate_id', 4)->count();
        return view('index', compact(['posts', 'count_script', 'count_app', 'count_plugin', 'count_cms']));
    }
}
