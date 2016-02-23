<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Phone;
use App\Ship;
use Carbon\Carbon;

class ShipRepository extends AbstractRepository
{
    protected $ship;

    public function __construct(Ship $ship)
    {
        $this->ship = $ship;
        parent::__construct($this->ship);
    }

    public function create(array $input)
    {
    	$this->ship->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$this->ship->phone_id = $input['phone'];
    	$this->ship->page_number = $input['page_number'];
    	$this->ship->receive_name = $input['receive_name'];
    	$this->ship->user_id = $input['user_name'];

    	$this->ship->save();

        // update phone number status
        $phone = Phone::find($input['phone']);
        $phone->status = 'success';
        $phone->save();
    }
}