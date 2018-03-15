<?php

use App\Models\Training\Processing\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class PictureParser
 */
class PictureParser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            $url = 'https://pdd-russia.com/pdd-online/img/ab/' . $question->ticket_num . '_' . $question->question_num . '.jpg';
            $options = [
                CURLOPT_RETURNTRANSFER => true,     // return web page
                CURLOPT_HEADER         => false,    // don't return headers
                CURLOPT_FOLLOWLOCATION => true,     // follow redirects
                CURLOPT_ENCODING       => "",       // handle all encodings
                CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36", // who am i
                CURLOPT_AUTOREFERER    => true,     // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
                CURLOPT_TIMEOUT        => 120,      // timeout on response
                CURLOPT_MAXREDIRS      => 10,       // s
                CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
            ];
            $headers = [
                'Content-Type: application/json',
                'Referer: https://pdd-russia.com/pdd-online/ekzamen.html',
                'X-Requested-With: XMLHttpRequest'
            ];
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            $info = curl_getinfo ($ch );
            curl_close($ch);

            if ($info['http_code'] !== 404) {
                //dd($result);

                //$response = new File($result);

                $name = str_random(15);

                Storage::put('public/question/' . $question->id . '/' . $name . '.jpg', $result);
            }
        }
    }
}
