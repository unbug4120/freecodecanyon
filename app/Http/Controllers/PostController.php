<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Naxon\UrlUploadedFile\UrlUploadedFile;
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

    public function scrap_post()
    {
        ini_set('max_execution_time', 300000);
        $get_url = Scrap::select('url', 'cate_id')->get();
        foreach ($get_url as $result) {
            $url = '' . $result->url . '';
            $content = $this->getContent($url);
            $html = HtmlDomParser::str_get_html($content);
            $find_url = $html->find('.full-news a', 0)->plaintext;
            $str = "https://codecanyon.net";
            if (strpos($find_url, $str) == false) {
                continue;
            } else {
                $content_cayon = $this->getContent($find_url);
                $html_cayon = HtmlDomParser::str_get_html($content_cayon);
                $find_images = $html_cayon->find('.item-preview a img');
                foreach ($find_images as $value) {
                    $path = str_replace('auto=compress%2Cformat&amp;q=80&amp;fit=crop&amp;crop=top&amp;max-h=8000&amp;max-w=590&amp;', 'auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&', $value->src);
                    $name = explode('/', $value->src);
                    $file = UrlUploadedFile::createFromUrl($path);
                    $file->storeAs('images', $name[4] . '.' . $file->extension());
                }
            }
        }
    }

    public function scrap()
    {
        $scrap_post = Scrap::select('url')->get();
        foreach ($scrap_post->link as $result) {
            $url = '' . $result . '';
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
