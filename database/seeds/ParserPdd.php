<?php

use App\Models\Training\Processing\Question;
use Illuminate\Database\Seeder;

/**
 * Class ParserPdd
 */
class ParserPdd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billet = 1;
        $max = 40;
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

        //dd($url);

        while ($billet <= $max) {
            $url = 'https://pdd-russia.com/pdd-online/quest/ab/bilet/b' . $billet . '.json';
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result);

            //dd($response[1]->quest);

            foreach ($response as $res) {
                $quest = Question::create([
                    'description' => $res->quest,
                    'comment' => $res->comments,
                    'ticket_num' => $billet,
                    'question_num' => $res->questNumber
                ]);

                foreach ($res->v as $key => $item) {
                    if ($item) {
                        $quest->answers()->create([
                            'title' => $item,
                            'correct' => ($key + 1) === $res->otvet ? 1 : 0
                        ]);
                    }
                }

            }

            $billet++;

            sleep(5);
        }
    }
}
