<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

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
}
