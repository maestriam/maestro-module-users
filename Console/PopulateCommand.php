<?php

namespace Maestro\Users\Console;

use Illuminate\Console\Command;
use Maestro\Users\Support\Concerns\HasUserFactory;


class PopulateCommand extends Command
{
    use HasUserFactory;

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
        $this->factory()->populate(100);
        
        $this->info('Users created with successful');      
    }
}