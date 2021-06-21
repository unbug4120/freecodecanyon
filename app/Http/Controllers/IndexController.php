<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $post = Post::paginate(12);
        $count_script = Post::select('*')->where('cate_id', 1)->count();
        $count_app = Post::select('*')->where('cate_id', 2)->count();
        $count_plugin = Post::select('*')->where('cate_id', 3)->count();
        $count_cms = Post::select('*')->where('cate_id', 3)->count();
        return view('index', compact(['post', 'count_script', 'count_app', 'count_plugin', 'count_cms']));
    }
}
