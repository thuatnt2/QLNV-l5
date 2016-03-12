<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\File;

class FileRepository extends AbstractRepository
{
    protected $files;

    public function __construct(File $files)
    {
        $this->files = $files;
        parent::__construct($this->files);
    }

}