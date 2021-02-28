<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all time db';

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
     * Execute the console command.1
     *
     * @return mixed
     */
    public function handle()
    {
        $allData = DB::select('select * from reservation where created_at < NOW() - INTERVAL 2 HOUR');
        foreach ($allData as $data){
            DB::update('update reservation set confirm = ?  where id = ?', [1 , $data->id]);
        }
        echo 'operation done';
    }
}
