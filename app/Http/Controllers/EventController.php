<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function show() {
        $events = Event::get();

        if($events->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => [
                    'dataPanduan' => $events,
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
