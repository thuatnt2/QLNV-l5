<?php
/**
 * Created by PhpStorm.
 * User: TNT
 * Date: 12/13/2015
 * Time: 4:38 PM
 */
namespace App\Repositories;


use App\Unit;

class UnitRepository extends AbstractRepository
{
    public $unit;
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
        parent::__construct($this->unit);
    }

    public function create(array $data)
    {
        $this->unit->description = $data['description'];
        $this->unit->symbol = $data['symbol'];
        $this->unit->block = $data['block'];
        $this->unit->save();
    }
    public function update($id, array $data)
    {
        $unit = $this->findById($id);
        $unit->description =  $data['description'];
        $unit->symbol = $data['symbol'];
        $unit->block = $data['block'];
        $unit->save();
    }


}