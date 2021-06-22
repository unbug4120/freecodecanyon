<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $posts = Post::select('*')->where('title', 'like', '%' . $query . '%')->paginate(12);
        $count_script = Post::select('*')->where('cate_id', 1)->count();
        $count_app = Post::select('*')->where('cate_id', 2)->count();
        $count_plugin = Post::select('*')->where('cate_id', 3)->count();
        $count_cms = Post::select('*')->where('cate_id', 4)->count();
        return view('search', compact(['posts', 'count_script', 'count_app', 'count_plugin', 'count_cms', 'query']));
    }
}
