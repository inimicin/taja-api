<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function show() {
        $panduans = Panduan::get();
        
        if($panduans->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => [
                    'dataPanduan' => $panduans,
                ],
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Tidak Ada Data',
            'data' => [],
        ]);
    }
}
