<?php

namespace App\Console\Commands;

use App\Utils\JsonConvertor;
use EllGreen\LaravelLoadFile\Laravel\Facades\LoadFile;
use Illuminate\Console\Command;

class ImportArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:articles {path : Absolute path to JSON file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import articles from given JSON file and insert it to database';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', 600);

        $start = microtime(true);

        $csv = JsonConvertor::csv($this->argument('path'), '/articles');

        LoadFile::file($csv, true)
            ->into('articles')
            ->replace()
            ->columns(['id', 'name', 'stock'])
            ->fieldsTerminatedBy(',')
            ->fieldsEnclosedBy('"', true)
            ->linesTerminatedBy('\n')
            ->load();

        $executionTime = (microtime(true) - $start);

        $this->info("Execution Time: $executionTime sec.");

        return 0;
    }
}
