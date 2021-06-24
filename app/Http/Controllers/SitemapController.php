<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap', [
            'post' => $post,
        ])->header('Content-Type', 'text/xml');
    }
    
}
