<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\Kind;
use App\Order;
use App\Purpose;
use App\Category;
use Auth;
use App\Repositories\CategoryRepository;
use App\Repositories\KindRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PurposeRepository;
use App\Repositories\UnitRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file, $folder)
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

    public function excelForOrder($value)
    {
        // $value is array
        $order['user'] = Auth::user()->id;
        $today = Carbon::now();
        $order['created_at'] = $today->day. '/'. $today->month. '/'. $today->year;
        $kind = new KindRepository(new Kind);
        $order['kind'] = $kind->findBy('symbol', $value['tinh_chat'],['id'])->id;
        $category = new CategoryRepository(new Category);
        $order['category'] = $category->findBy('symbol', $value['loai_dt'],['id'])->id;
        $unit = new UnitRepository(new Unit);
        $order['unit'] = $unit->findBy('symbol', $value['donviyc'], ['id'])->id;
        $purpose = new PurposeRepository(new Purpose);
        $order['purpose'] = $purpose->findBy('group', 'monitor', ['id'])->id;
        $order['number_cv'] = (int) $value['cvde'];
        $order['number_cv_pa71'] = (int) $value['cvdi'];
        $order['order_name'] = $value['ho_ten_dt'];
        $order['order_phone'] = [$value['so_dt']];
        $order['date_request'] = $value['ngay_bd']->day . '/'. $value['ngay_bd']->month. '/'.$value['ngay_bd']->year .'-'. $value['ngaykt']->day . '/'. $value['ngaykt']->month. '/'.$value['ngaykt']->year;
        $order['customer_name'] = $value['tents'];
        $order['customer_phone'] = (int) $value['dtts'];
        $order['comment'] = "";
 
        return $order;
    }

    public function excelForShip($rows)
    {
        $input['created_at'];
        $input['phone'];
        $input['number_cv_pa71'];
        $input['news'];
        $input['page_news'];
        $input['page_list'];
        $input['page_xmctb'];
        $input['page_imei'];
        $input['receive_name'];
        $input['user_name'];
        return $ship;
    }
}
