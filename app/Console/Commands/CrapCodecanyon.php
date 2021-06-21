<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scrap;
use App\Models\Post;
use Naxon\UrlUploadedFile\UrlUploadedFile;
use duongdat\phpSimple\HtmlDomParser;

class CrapCodecanyon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Codecanyon:Crap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', 300000);
        $get_url = Scrap::select('id', 'name', 'canyon_url', 'url', 'cate_id')->where('status', 0)->get();
        foreach ($get_url as $result) {
            echo $result->canyon_url . "\n";
            $content = $this->getContent($result->url);
            $html = HtmlDomParser::str_get_html($content);
            $find_content = $html->find('.full-news', 0)->plaintext;
            $get_content = explode("\r\n", $find_content);
            $content_canyon = $this->getContent($result->canyon_url);
            $html_cayon = HtmlDomParser::str_get_html($content_canyon);
            $str_e = "You are being";
            if (strpos($html_cayon, $str_e) !== false) {
                preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $html_cayon, $match);
                $content_cayon_parse = $this->getContent($match[0][0]);
                $html_cayon_parse = HtmlDomParser::str_get_html($content_cayon_parse);
                $find_images = $html_cayon_parse->find('.item-preview a img');
                $find_meta = $html_cayon_parse->find('meta');
            } else {
                $find_images = $html_cayon->find('.item-preview a img');
                if (count($find_images) == 0) {
                    $find_images = $html_cayon->find('.item-preview img');
                }
                $find_meta = $html_cayon->find('meta');
            }
            dd($find_images[0]->src);
            $path = str_replace('auto=compress%2Cformat&amp;q=80&amp;fit=crop&amp;crop=top&amp;max-h=8000&amp;max-w=590&amp;', 'auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&', $find_images[0]->src);
            $name = explode('/', $find_images[0]->src);
            if ($name[2] == "s3.amazonaws.com") {
                $file = UrlUploadedFile::createFromUrl($path);
                $file->storeAs('images', $name[5] . '.' . $file->extension());
            } else {
                $file = UrlUploadedFile::createFromUrl($path);
                $file->storeAs('images', $name[4] . '.' . $file->extension());
            }
            $post = new Post();
            $post->title = $result->name;
            $post->content = $get_content[2];
            $post->description = $find_meta[2]->content;
            $post->cate_id = $result->cate_id;
            $get_slug = explode("/", $result->url);
            $slug_cut = explode("/", $get_slug[4]);
            $slug_cut_dot = explode(".", $slug_cut[0]);
            $slug_cut_strike = explode("-", $slug_cut_dot[0]);
            $slug = str_replace($slug_cut_strike[0] . '-', '', $slug_cut_dot[0]) . '-' . $result->id;
            $post->slug = $slug;
            $post->status = 1;
            $post->thumb = 'images/' . $name[4] . '.' . $file->extension();
            $post->save();
            $scrap = Scrap::find($result->id);
            $scrap->status = 1;
            $scrap->save();
        }
    }
    private function getContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.106 Safari/537.36");
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
