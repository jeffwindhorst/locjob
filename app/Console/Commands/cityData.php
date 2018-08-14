<?php

namespace App\Console\Commands;

use App\City;
use Illuminate\Console\Command;

class cityData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add cities data to the database.';

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
        $JSONFile = public_path('data/cityData.json');
        if(!file_exists($JSONFile) || !is_readable($JSONFile))
            return false;
        
        $header = null;
        $data = [];
        
        $jdata = json_decode(file_get_contents($JSONFile), true);
        echo "Inserting: " . count($jdata) . " city records.\n";

        // Clear the table first then populate it.
        City::truncate();
        City::insert($jdata);

        echo "Cities imported.\n";
        echo City::count() . " currently in the system.\n";
    }
}
