<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Category;

class CategoryRepository extends AbstractRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
        parent::__construct($this->category);
    }
}