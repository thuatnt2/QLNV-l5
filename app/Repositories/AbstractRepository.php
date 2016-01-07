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
    public function all($columns = ['*'])
    {
        return $this->model->orderBy('created_at', 'desc')->get($columns);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function create(array $data)
    {

        $this->model->unguard();
        $model = $this->model->fill($data);
        $this->model->reguard();

        return $model->save();
        
    }

    public function update($id, array $input)
    {
        $model = $this->findById($id);
        $model->unguard();
        $model = $model->fill($input);
        $model->reguard();

        return $model->save();

    }
    /**
     * format data from database to array inspecific ['id' => 'name']
     * @param  Array
     * @return Array     
     */
    public function formatData($items) {
        
        $output = [];
        foreach ($items as $item) {
            $output[$item->id] = $item->symbol;
        }
        
        return $output;
    }
}