<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Ship;

class ShipRepository extends AbstractRepository
{
    protected $ship;

    public function __construct(Ship $ship)
    {
        $this->ship = $ship;
        parent::__construct($this->ship);
    }

    public function paginate($perPage = 5, $columns = ['*'])
    {
    	return $this->ship
    				->with(['phone'])
    				->orderBy('created_at', 'desc')
                    ->paginate($perPage, $columns);
    }

    public function create(array $input)
    {
    	$this->ship->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$this->ship->phone_id = $input['phone'];
    	$this->ship->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->ship->page_number = $input['page_number'];
    	$this->ship->receive_name = $input['receive_name'];
    	$this->ship->user_id = $input['user_name'];

    	$this->ship->save();
    }
}