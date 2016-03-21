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

    public function paginate($purpose = '', $perPage = 5, $with = [''], $columns = ['*'])
    {
        $result = $this->model
                       ->with($with)
                       ->orderBy('created_at', 'desc');
        switch ($purpose) {
            case 'monitor':
                $result->whereNotNull('page_news');
                break;
            case 'list-xmctb':
                $result->whereNotNull('page_list');
                break;
            case 'imei':
                $result->whereNotNull('page_imei');
                break;
            default:
                # code...
                break;
        }

        return $result->paginate($perPage,$columns);
    }

    public function create(array $input, $fileName = '')
    {
    	$this->ship->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$this->ship->phone_id = $input['phone'];
        $this->ship->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->ship->news = $input['news'];
        $this->ship->page_news = $input['page_news'];
        $this->ship->page_list = $input['page_list'];
        $this->ship->page_imei = $input['page_xmctb'];
    	$this->ship->receive_name = $input['receive_name'];
    	$this->ship->user_id = $input['user_name'];
        $this->ship->file_name = $fileName;
    	$this->ship->save();

        // update phone number status
        if($input['news'] == null) {
            $phone = Phone::find($input['phone']);
            $phone->status = 'success';
            $phone->save();    
        }
        
        return $this->ship;
    }
    public function update($id, array $input, $fileName='')
    {
        $ship = $this->findById($id);
        // update phone status
        if ($input['news'] == null) {
            $phone = $ship->phone;
            $phone->status = 'warning';
            $phone->save(); 

            $phone = Phone::find($input['phone']);
            $phone->status = 'success';
            $phone->save(); 
        }
        
        // update ship
        $ship->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
        $ship->phone_id = $input['phone'];
        $ship->number_cv_pa71 = $input['number_cv_pa71'];
        $ship->news = $input['news'];
        $ship->page_news = $input['page_news'];
        $ship->page_list = $input['page_list'];
        $ship->page_imei = $input['page_xmctb'];
        $ship->receive_name = $input['receive_name'];
        $ship->user_id = $input['user_name'];
        if ($fileName != '') {
            $ship->file_name = $fileName;
        }
        $ship->save();

        return $ship;
    }
    public function delete($id, $update = false)
    {
        $ship = $this->findById($id);
        // update status if order list
        $phone = $ship->phone;
        if($update) {
            $phone->status = 'warning';
            $phone->save();
        }
        $ship->delete();
    }
}