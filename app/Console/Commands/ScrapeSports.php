<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\Storage;

class ScrapeSports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:sports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape sports teams from Wikipedia';

    protected $collections = [
        'baseball',
        'football',
        'basketball',
        'hockey',
        'soccer',
    ];
    
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
        $url = "https://en.wikipedia.org/wiki/List_of_professional_sports_teams_in_the_United_States_and_Canada";
        $filename = 'data/sportsTeamScrapeData.xml';
        $sportsData = [];
        
        if(!Storage::exists($filename)) {
            $file = file_get_contents($url);
            Storage::put($filename, $file);
        }
        
        $html = file_get_contents(Storage::get($filename));
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $sxml = simplexml_import_dom($doc);
        
        $h2s = $sxml->xpath('//h2');
        echo count($h2s);
        exit;
        $i=0;
        foreach($h2s as $sport) {
            if($i >= 3) {
                $sportsData[] = $sport;
                echo $sport;
            }
            
            $i++;
        }
        
//        print_r($sportsData[1]->table);
    }
    
}


