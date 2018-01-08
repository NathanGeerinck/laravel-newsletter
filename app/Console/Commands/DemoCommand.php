<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-newsletter:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulling the demo data into the database';

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
        $this->line("\nImporting demo data..");

        //$this->callSilent('db:seed');

        $this->line("Demo data imported.\n");
    }
}
