<?php

namespace App;

use Symfony\Component\DomCrawler\Crawler;
use Embed\Embed;

class Article 
{
    public $url, $description, $title;
    private $info;

    public function __construct($url, $title="")
    {
    	$this->title = $title;
    	$this->url = $url;
    	try {
	    	$this->info = Embed::create($this->url);
	    	$this->description = $this->info->description;
	    	// $this->image = $this->info->image;
    	} catch (\Exception $e) {
    		echo "\n problem with url $this->url \n";
    	}

        // get more info from description.
        $this->improveDescription();
    }

    private function improveDescription(){
    	// get improved content from mercury web parser

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://mercury.postlight.com/parser?url=' . $this->url, [
            'headers' => [
                'x-api-key' => env('MERCURY_KEY'),
                'Content-Type'     => 'application/json',
            ]
        ]);

        if ($res->getStatusCode() == 200){
            try {
                $this->description = json_decode($res->getBody()->getContents())->excerpt;
            } catch (\Exception $e) {
                
            }
        }
    }


}
