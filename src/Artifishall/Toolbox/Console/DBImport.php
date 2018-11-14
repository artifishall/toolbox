<?php

namespace Artifishall\Toolbox\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DBImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import {--s|skipbackup} {--d|debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Database Backup';

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
        $production = \App::environment('production');

        if ($production == true && $this->confirm('Are you sure you want to import the database into production?') == false) {
            die();
        }

        $connection = config('database.default');

        $dir = collect(File::allFiles(storage_path('app/backup')))
                            ->map(function ($file) {
                                return $file->getBaseName();
                            });

        $file = $this->choice('Which File do you want to import?', $dir->all());

        if ($production == true || !$this->option('skipbackup')) {
            $this->call('db:backup');
        }

        $db = config("database.connections.$connection");
        $arr = [
            'host'      => $db['host'],
            'port'      => $db['port'],
            'username'  => $db['username'],
            'password'  => escapeshellarg($db['password']),
            'database'  => $db['database'],
            'file'      => storage_path("app/backup/$file")
        ];

        $command = vsprintf('mysql -h %s -P %s -u %s --password=%s %s < %s', $arr);

        if ($this->option('debug')) {
            $this->line($command);
        }else{
            $this->info(exec($command));
        }

    }
}
