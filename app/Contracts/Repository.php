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
    public function all();
    public function findById($id);
    public function delete($id);
    public function create(array $input);
    public function edit(array $input);

}