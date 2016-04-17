<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\Kind;
use App\Purpose;
use App\Category;
use Auth;
use App\Unit;
use App\Repositories\CategoryRepository;
use App\Repositories\KindRepository;

use App\Repositories\PurposeRepository;
use App\Repositories\UnitRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadFile($file, $folder)
    {
        $alowedExtension = ['doc', 'docx', 'pdf', 'xls', 'xlsx'];
        $extention = $file->getClientOriginalExtension();
        $size = $file->getClientSize();
        $originalName = $file->getClientOriginalName();
        $fileName = Carbon::now()->timestamp . '.' . $extention;
        $destinationPath = base_path() . '/data/' . $folder;
        if (in_array($extention, $alowedExtension)) {

            $file->move($destinationPath, $fileName);

            return [
                    'name' => $fileName,
                    'original-name' => $originalName,
                    'content-type' => $extention,
                    'size'  => $size,
                    'path' => $destinationPath
            ];
        };	
        return false;
    }

    protected function excelForOrder($value, $intention)
    {
        // $value is array
        $order['user'] = Auth::user()->id;
        $today = Carbon::now();
        $order['created_at'] = $today->day. '/'. $today->month. '/'. $today->year;
        if (isset($value['tinh_chat'])) {
            $kind = new KindRepository(new Kind);
            $k = $kind->findBy('symbol', $value['tinh_chat'],['id']);
            // dd($k);
            $order['kind'] = $this->checkObject($k, $kind, ['symbol' => $value['tinh_chat'], 'description' => 'System auto create']);
        } else {
            $order['kind'] = null;
        }
        
        if (isset($value['loai_dt'])) {
            $category = new CategoryRepository(new Category);
            $c = $category->findBy('symbol', $value['loai_dt'],['id']);
            $order['category'] = $this->checkObject($c, $category, ['symbol' => $value['loai_dt'],'description' => 'System auto create']);
        } else {
             $order['category'] = null;
        }

        $unit = new UnitRepository(new Unit);
        $u = $unit->findBy('symbol', $value['don_vi_yc'], ['id']);
        if (isset($u)) {
            $order['unit'] = $u->id;
        } else {
            // create
            $order['unit'] = $unit->create(['description' =>'System auto create',
                                            'symbol' => $value['don_vi_yc'], 
                                            'block' => 'AN'
                                            ])->id;
        }
        $purpose = new PurposeRepository(new Purpose);
        $order['purpose'] = $purpose->findBy('group', $intention, ['id'])->id;
        if (isset($value['ngay_bat_dau']) && isset($value['ngay_ket_thuc'])) {
            $order['date_request'] = $value['ngay_bat_dau']->day . '/'. $value['ngay_bat_dau']->month. '/'.$value['ngay_bat_dau']->year .'-'. $value['ngay_ket_thuc']->day . '/'. $value['ngay_ket_thuc']->month. '/'.$value['ngay_ket_thuc']->year;
        } else {
            $order['date_request'] = null;
        };
        $order['order_phone'] = explode("\n", $value['so_dien_thoai']);
        $order['number_cv'] = $this->checkData('cv_den', $value);
        $order['number_cv_pa71'] = $this->checkData('cv_di', $value);
        $order['order_name'] = $this->checkData('ho_ten_doi_tuong', $value);
        $order['customer_name'] = $this->checkData('ten_ts', $value);
        $order['customer_phone'] = $this->checkData('dien_thoai_ts', $value);
        $order['comment'] = "";
 
        return $order;
    }

    protected function excelForShip($value, $phone)
    {
        $ship['user_name'] = Auth::user()->id;
        if (isset($value['ngay_giao'])) {
            $ship['created_at'] = $value['ngay_giao']->day. '/'. $value['ngay_giao']->month. '/'. $value['ngay_giao']->year;
        } else {
            $today = Carbon::now();
            $ship['created_at'] = $today->day. '/'. $today->month. '/'. $today->year;
        }
        $ship['phone'] = $phone;
        $ship['number_cv_pa71'] = $this->checkData('cv_pa71', $value);
        $ship['news'] = $this->checkData('so_ban_tin', $value);
        $ship['page_news'] = $this->checkData('so_trang_tin', $value);
        $ship['page_list'] = $this->checkData('so_trang_list', $value);
        $ship['page_xmctb'] = $this->checkData('so_trang_xmctb', $value);
        $ship['page_imei'] = $this->checkData('so_trang_imei', $value);
        $ship['receive_name'] = $this->checkData('nguoi_nhan', $value);
        return $ship;
    }

    private function checkData($keyGet, $data)
    {
        if (isset($data[$keyGet])) {
            return $data[$keyGet];
        }
        return null;
    }

    private function checkObject($obj, $newObj, array $data)
    {
        if(isset($obj->id)) {
            return $obj->id;
        }
        return $newObj->create($data)->id;
    }
}
