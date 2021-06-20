<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scrap;
use App\Models\Image;
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
        $get_url = Scrap::select('url', 'cate_id')->get();
        foreach ($get_url as $result) {
            $url = '' . $result->url . '';
            $content = $this->getContent($url);
            $html = HtmlDomParser::str_get_html($content);
            $find_url = $html->find('.full-news a', 0)->plaintext;
            $str = "https://codecanyon.net";
            if (strpos($find_url, $str) !== false) {
                echo 1;
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
