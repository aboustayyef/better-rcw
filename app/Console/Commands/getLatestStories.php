<?php

namespace App\Console\Commands;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use \App\Articles;

class getLatestStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getLatestStories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets The Latest Stories';

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
     * @return mixed
     */
    public function handle()
    {

        \Mail::to('mustapha.hamoui@gmail.com')->send(new \App\Mail\NewsletterSent);
    }
}
