<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-newsletter:install {--demo : Import demo data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installation of the Laravel Newsletter application';

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
        $this->info("\nWelcome to the installation process of Laravel Newsletter!\n");

        if (! $this->confirm('Do you like to continue with the installation of Laravel Newsletter?')) {
            $this->info("\nYou stopped the installation of Laravel Newsletter\n");

            return;
        }

        $this->install();

        if ($this->option('demo') || $this->confirm('Do you like to import the demo data?')) {
            $this->call('laravel-newsletter:demo');
        }

        $this->info("You've completed the installation process of Laravel Newsletter successfully!\n");
    }

    protected function install()
    {
        $this->line("\nInstalling..");

        if (! file_exists('.env')) {
            exec('mv .env.example .env');
            $this->line("\n.env file successfully created\n");
        }

        if (strlen(config('app.key')) === 0) {
            $this->call('key:generate');
            $this->line("\nSecret key properly generated\n");
        }

        $dbEnv['DB_DATABASE'] = $this->ask('Database name');
        $dbEnv['DB_USERNAME'] = $this->ask('Database user');
        $dbEnv['DB_PASSWORD'] = $this->secret('Database password ("null" for no password)');
        $this->updateEnvironmentFile($dbEnv);

        $this->line("Application installed.\n");
    }

    /**
     * Update .env file from an array of $key => $value pairs.
     *
     * @param array $updatedValues
     * @return void
     */
    protected function updateEnvironmentFile($updatedValues)
    {
        foreach ($updatedValues as $key => $value) {
            file_put_contents($this->laravel->environmentFilePath(), preg_replace(
                "/{$key}=(.*)/",
                $key.'='.$value,
                file_get_contents($this->laravel->environmentFilePath())
            ));
        }
    }
}
