<?php

namespace Maestro\Users\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Maestro\Users\Support\Facade\Users;

class PopulateCommand extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake users to test module';

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
        $this->populate(); 
        
        $this->info('Users created with successful');      
    }

    private function populate() : self
    {        
        for ($i=0; $i < 100; $i++) { 
            Users::factory()->model();
        }   

        return $this;
    }
}