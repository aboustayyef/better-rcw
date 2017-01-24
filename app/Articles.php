<?php

namespace App;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Collection;
use \Cache;

class Articles 
{
	public $list;

    public function __construct(){
    	
    	$this->list = new Collection;

    	 $c = new Crawler;

        // use caching so we don't have to make an http request every time
        if (! \Cache::has('pageContent')) {
            \Cache::put('pageContent', file_get_contents('http://realclearworld.com'), 30000);
        }

        $c->addHtmlContent(\Cache::get('pageContent'));
        
        // raw nodes
        $nodes = $c->filter('.post');
        
        // laravel collection that will hold links
        $nodesCollection = new Collection;

        // sanitize for only articles (ignore other links)
        $nodes->each(function($node) use ($nodesCollection){
            // nodes that contain the <strong> tag are not normal links. Remove 
            if (!str_contains($node->html(), '<strong>')) {
                $linkNode = $node->filter('a')->first();
                $nodesCollection->push($linkNode);
            }
        });

        // reduce to 20 
        $nodesCollection->splice(20);

        $this->list = $nodesCollection->map(function($node){
            return new Article($node->text(), $node->attr('href'));
        });

    }

}
