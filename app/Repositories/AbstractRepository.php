<?php
/**
 * Created by PhpStorm.
 * User: TNT
 * Date: 12/13/2015
 * Time: 3:55 PM
 */
namespace App\Repositories;

use App\Contracts\Repository;
use Illuminate\Database\Eloquent\Model;
abstract class AbstractRepository implements Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}