<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\News;

class NewsRepository extends AbstractRepository
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
        parent::__construct($this->news);
    }
}