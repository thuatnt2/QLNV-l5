<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\News;
use Carbon\Carbon;

class NewsRepository extends AbstractRepository
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
        parent::__construct($this->news);
    }
    public function create(array $input, $fileName = '')
    {
    	$this->news->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$this->news->phone_id = $input['phone'];
    	$this->news->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->news->number_news = 1;
    	$this->news->page_number = $input['page_number'];
        $this->news->file_name = $fileName;
    	$this->news->receive_name = $input['receive_name'];
    	$this->news->user_id = $input['user_name'];

    	$this->news->save();
    }
}