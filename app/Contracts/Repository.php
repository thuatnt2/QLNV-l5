<?php
/**
 * Created by PhpStorm.
 * User: TNT
 * Date: 12/13/2015
 * Time: 3:50 PM
 */
namespace App\Contracts;


interface Repository
{
	/**
     *
     * @param array $columns
     */
    public function all($columns = ['*']);
    /**
     *
     * @param string|int $id
     * @param array $columns
     */
    public function findById($id, $columns = ['*']);

    /**
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     */
    public function findAllBy($field, $value, $columns = ['*']);
    public function paginate($currentPage = 1, $perPage = 5, $columns = ['*']);
    public function delete($id);
    public function create(array $input);
    public function update($id, array $input);

}