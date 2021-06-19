<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Post;
use App\Models\Scrap;
use duongdat\phpSimple\HtmlDomParser;

class PostController extends Controller
{
    public function index()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'scam_value' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
        if ($request->TotalImages > 0) {

            for ($x = 0; $x < $request->TotalImages; $x++) {

                if ($request->hasFile('images' . $x)) {
                    $file      = $request->file('images' . $x);

                    $path = $file->store('public/images');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $path;
                }
            }
            Image::insert($insert);
            return 'Thành công!';
        }
    }

    public function scrap_post($id)
    {
        for ($i = 1; $i < $id + 1; $i++) {
            $url = 'https://www.codelist.cc/page/' . $i . '/';
            $content = $this->getContent($url);
            $html = HtmlDomParser::str_get_html($content);
            $links = $html->find('.news-title h3 a');
            foreach ($links as $result) {
                $scrap = new Scrap;
                $scrap->name = $result->title;
                $scrap->url =  $result->href;
                $scrap->status =  0;
                $scrap->save();
            }
        }
    }

    public function scrap()
    {
        $scrap_post = Scrap::select('url')->get();
        foreach ($scrap_post->link as $result) {
            $url = ''.$result.'';
            $content = $this->getContent($url);
            $html = HtmlDomParser::str_get_html($content);
            $links = $html->find('.full h1 b');
            dd($links);
            foreach ($links as $result) {
                $scrap = new Scrap;
                $scrap->name = $result->title;
                $scrap->url =  $result->href;
                $scrap->status =  0;
                $scrap->save();
            }
        }
    }

    private function getContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
