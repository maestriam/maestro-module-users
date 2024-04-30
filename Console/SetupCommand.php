<?php

namespace Maestro\Users\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupCommand extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup module configuration.';

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
        $this->migrateDatabase()->seedModule(); 
        
        $this->info('Users module configurated with successful');      
    }

    private function migrateDatabase() : self
    {        
        Artisan::call('maestro:migrate Users');

        return $this;
    }

    private function seedModule() : self
    {
        Artisan::call('maestro:seed Users');

        return $this;
    }
}