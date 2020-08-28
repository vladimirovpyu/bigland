<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class bigland extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bigland:search {numbers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search cadastral numbers';

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
        $numbers = explode(',',$this->argument('numbers'));
        $service = app()->make('App\Services\BiglandService\BiglandService');
        $service->search($numbers);

        $data = $service->getFromDatabase($numbers);
        $this->table(['cn','Address','Price','Area'],$data);

        return 0;
    }
}
