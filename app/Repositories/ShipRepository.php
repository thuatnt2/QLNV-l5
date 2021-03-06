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
      
        return $this->model
                    ->with($with)
                    ->whereHas('phone.order.purpose', function($q) use ($purpose){
                        $q->where('purposes.group', $purpose);
                    })
                    ->orderBy('date_submit', 'desc')
                    ->paginate($perPage,$columns);
    }

    public function create(array $input, $fileName = '')
    {
    	$this->ship->date_submit = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$this->ship->phone_id = $input['phone'];
        $this->ship->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->ship->news = $input['news'];
        $this->ship->page_news = $input['page_news'];
        $this->ship->page_list = $input['page_list'];
        $this->ship->page_xmctb = $input['page_xmctb'];
        $this->ship->page_imei = $input['page_imei'];
    	$this->ship->receive_name = $input['receive_name'];
    	$this->ship->user_id = $input['user_name'];
        $this->ship->file_name = $fileName;
    	$this->ship->save();
        // syn network table
        if (isset($input['network'])) {
            $this->ship->networks()->sync($input['network']);
        }
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
        $ship->page_xmctb = $input['page_xmctb'];
        $ship->page_imei = $input['page_imei'];
        $ship->receive_name = $input['receive_name'];
        $ship->user_id = $input['user_name'];
        if ($fileName != '') {
            $ship->file_name = $fileName;
        }
        $ship->save();

        // syn network table
        if (isset($input['network'])) {
            $ship->networks()->sync($input['network']);
        }
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