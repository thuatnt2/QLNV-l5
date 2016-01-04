<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository 
    {name : Repository name}
    {--model= : (Optional) Model name}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create repository fo model';
    private $repositoryPath;
    private $modelPath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->repositoryPath = config('repository.repository_path', 'app/Repositories');
        $this->modelPath = config('repository.repository_model', 'App\\');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $repositoryContent = '';
        $repositoryName = $this->argument('name');
        $modelName = $this->option('model');
        $repositoryPath = sprintf('%s/%s.php', trim($this->repositoryPath, '/'), $repositoryName);

        if ($repositoryName) {

            $repositoryContent = $this->getRepositoryContent($repositoryName, $modelName);
        }
        // if File not exits
        if (!File::isFile($repositoryPath)) {

            $this->setRepositoryContent($repositoryPath, $repositoryContent);

        } else {

            $overrideConfirm = $this->ask('Repository is existing. Are you sure you want to override it? (y/n)');
            $yesAnswerList = ['y', 'yes'];
            if (in_array(strtolower($overrideConfirm), $yesAnswerList)) {

                $this->setRepositoryContent($repositoryPath, $repositoryContent);

            }

        }


    }

    protected function setRepositoryContent($repositoryPath, $repositoryContent)
    {
        File::put($repositoryPath, $repositoryContent);
        $this->info('Create repository succeced');
    }
    protected function getRepositoryContent($repositoryName, $modelName = '')
    {
        $repositoryContent = "<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\\".ucfirst($modelName).";

class {$repositoryName} extends AbstractRepository
{";
        if ($modelName) {
            $repositoryContent .= "
    protected $".strtolower($modelName).";

    public function __construct(".ucfirst($modelName)." $".strtolower($modelName).')
    {
        $this->'.strtolower($modelName). " = $".strtolower($modelName).';
        parent::__construct($this->'.strtolower($modelName).");
    }";
        }
        $repositoryContent .= "
}";

        return $repositoryContent;
    }
}
