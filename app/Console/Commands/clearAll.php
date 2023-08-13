<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class clearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all {--force} {--map}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear all caches (view, cache, config, log)';
    private $disk;

    /**
     * Create a new command instance.
     * @param \Illuminate\Filesystem\Filesystem $disk
     * @return void
     */
    public function __construct(Filesystem $disk)
    {
        parent::__construct();
        $this->disk = $disk;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('view:clear');
        $this->call('config:clear');
        $this->call('route:clear');

        foreach ($this->disk->allFiles(storage_path('logs')) as $file) {
            $this->disk->delete($file);
        }
        $this->info('log files cleared!');
        
        $this->info('debugbar files cleared!');
    }
}
