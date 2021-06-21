<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scrap;
use duongdat\phpSimple\HtmlDomParser;

class CrapCodelist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Codelist:Crap';

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
        $url = 'https://www.codelist.cc/';
        $content = $this->getContent($url);
        $html = HtmlDomParser::str_get_html($content);
        $find_id = $html->find('.pagination li a');
        $id = explode("/", $find_id[9]->href);
        for ($i = $id[4]; $i > 0; $i--) {
            echo 'https://www.codelist.cc/page/' . $i . '/' . "\n";
            $url = 'https://www.codelist.cc/page/' . $i . '/';
            $content = $this->getContent($url);
            $html = HtmlDomParser::str_get_html($content);
            $links = $html->find('.news-title h3 a');
            $cate = $html->find('.categ a');
            $category = explode("/", $cate[1]->href);
            foreach ($links as $key => $result) {
                $category = explode("/", $cate[$key]->href);
                if ($category[3] == "plugins") {
                    $cate_id = 3;
                } elseif ($category[3] == "mobile") {
                    $cate_id = 2;
                } elseif ($category[3] == "scripts") {
                    $cate_id = 1;
                } else {
                    $cate_id = 4;
                }
                $content = $this->getContent($result->href);
                $html = HtmlDomParser::str_get_html($content);
                $find_url = $html->find('.full-news a', 0)->plaintext;
                $str = "https://codecanyon.net";
                if (strpos($find_url, $str) !== false) {
                    $scrap = new Scrap;
                    $scrap->name = $result->title;
                    $scrap->canyon_url =  $find_url;
                    $scrap->url =  $result->href;
                    $scrap->cate_id = $cate_id;
                    $scrap->status =  0;
                    $get_url = Scrap::select('url')->where('url', $result->href)->get();
                    if (count($get_url) > 0) {
                        continue;
                    } else {
                        $scrap->save();
                    }
                }
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
