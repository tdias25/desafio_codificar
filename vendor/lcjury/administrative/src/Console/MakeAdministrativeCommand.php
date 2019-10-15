<?php

namespace Lcjury\Administrative\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeAdministrativeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:administrative';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic political administrative divisions like regions, provinces and communes';

    protected $models = [
        'Region.php', 
        'Province.php', 
        'Commune.php'
        ];

    protected $migrations = [
        'create_regions_table.php',
        'create_provinces_table.php',
        'create_communes_table.php'
        ];
    protected $seed = 'Chile.php';
    protected $time;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->time = time();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Administrative scaffolding generated successfully!');
        $this->exportMigrations();
        $this->exportSeeders();
        $this->exportModels();
    }
    protected function exportMigrations()
    {
        foreach($this->migrations as $migration)
        {
            $path = base_path('database/migrations/'.$this->getTimestamp().'_'.$migration);
            $this->line('<info>Created migration:</info> '.$path);
            copy(__DIR__.'/stubs/make/migrations/'.$migration, $path);
        }
    }
    protected function exportSeeders()
    {
        $path = base_path('database/seeds/'.'PoliticalTablesSeeder.php');
        copy(__DIR__.'/stubs/make/seeds/PoliticalTablesSeeder.php', $path);

        $filesystem = new Filesystem();
        $country = $filesystem->get(__DIR__.'/stubs/make/seeds/'.$this->seed);
        $seeder = $filesystem->get(__DIR__.'/stubs/make/seeds/PoliticalTablesSeeder.php');

        $stub = str_replace('DummyData', $country, $seeder);
        $filesystem->put($path, $stub);
        $this->line('<info>Created seeder:</info> '.$path);
        $this->line('You should add $this->call(PoliticalTablesSeeder::class); to you DatabaseSeeder');
    }
    protected function exportModels()
    {
        foreach($this->models as $model)
        {
            $path = base_path('app/'.$model);
            copy(__DIR__.'/stubs/make/models/'.$model, $path);
            $this->line('<info>Created Model:</info> '.$path);
        }
    }

    protected function getTimestamp()
    {
        return date('Y_m_d_His', $this->time++);
    }
}
