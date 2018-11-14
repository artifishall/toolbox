<?php

namespace Artifishall\Toolbox\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DBBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--t|table=*} {--i|ignore=*} {--c|connection=} {--clean} {--d|debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

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
        $connection = config('database.default');
        $tables = null;

        if ($this->option('connection')) {
            $connection = $this->option('connection');
        }

        if ($this->option('clean')) {
            Storage::deleteDirectory('backup');
            Storage::makeDirectory('backup');
        }

        if ($this->option('table')) {
            $tables = '--tables '.implode(' ', $this->option('table'));
        }

        $db = config("database.connections.$connection");
        $arr = [
            'host'      => $db['host'],
            'port'      => $db['port'],
            'username'  => $db['username'],
            'password'  => escapeshellarg($db['password']),
            'database'  => $db['database'],
            'tables'    => $tables,
            'ignore'    => null,
            'path'      => storage_path("app/backup"),
            'date'      => date('Y-m-d_his'),
        ];

        if ($this->option('ignore')) {
            $cmd = sprintf('--ignore-table=%s.', $db['database']);
            $arr['ignore'] = $cmd.implode(" $cmd", $this->option('ignore'));
        }

        if(!File::isDirectory('backup')){
            Storage::makeDirectory('backup');
        }

        $command = vsprintf('mysqldump -h %s -P %s -u %s --password=%s --add-drop-table --skip-lock-tables %s %s %s > %s/%1$s_%5$s_%9$s.sql', $arr);

        if ($this->option('debug')) {
            $this->line($command);
        }else{
            $this->info(exec($command));
        }

    }
}
