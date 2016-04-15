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
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->get($columns);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->model
                    ->find($id, $columns);
    }
    /**
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model
                    ->where($field, $value)
                    ->first($columns);

    }

    /**
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     */
    public function findAllBy($field, $value, $columns = ['*']) 
    {
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->where($field, $value)
                    ->get($columns);

    }
    public function paginate($perPage = 5, $with = [''], $columns = ['*'])
    {
        $result = $this->model
                      ->with($with)
                      ->orderBy('created_at', 'desc')
                      ->paginate($perPage,$columns);
        return $result;
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
        $model->save();
        return $model;
        
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
    // return date formart (Y-m-d)
    public function stringToDate($value = '')
    {
      $arr = str_split($value, 4);
      $y = $arr[1];
      $arr2 = str_split($arr[0], 2);
      $d = $arr2[0];
      $m = $arr2[1];
      return $y . '-' . $m . '-' . $d;
    }
    public function vn_str_filter ($str){

       $unicode = array(

           'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

           'd'=>'đ',

           'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

           'i'=>'í|ì|ỉ|ĩ|ị',

           'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

           'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

           'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

           'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

           'D'=>'Đ',

           'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

           'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

           'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

           'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

           'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

       );

      foreach($unicode as $nonUnicode=>$uni){

           $str = preg_replace("/($uni)/i", $nonUnicode, $str);

      }

       return $str;

   }
}