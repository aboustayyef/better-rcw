<?php

namespace App;

use Symfony\Component\DomCrawler\Crawler;
use Embed\Embed;

class Article 
{
    public $url, $description, $title, $image;
    private $info;

    public function __construct($title, $url)
    {
    	$this->title = $title;
    	$this->url = $this->expand($url);
    	try {
	    	$this->info = Embed::create($this->url);
	    	$this->description = $this->info->description;
	    	// $this->image = $this->info->image;
    	} catch (\Exception $e) {
    		echo "\n problem with url $this->url \n";
    	}
    }

    private function expand($url){
    	// Function to to take a realclearworld url and find the final url
    	return $url; // <--- for now
    }
}
