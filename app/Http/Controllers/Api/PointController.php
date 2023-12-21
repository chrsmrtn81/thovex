<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePointRequest;
use App\Models\Point;
use Illuminate\Support\Facades\Log;
use Throwable;

class PointController extends Controller
{
    public function index()
    {
        try {
            $points = Point::all();

            return response()->json($points);

        } catch (Throwable $t) {
            Log::error($t);

            return response()->json();
        }
    }

    public function store(StorePointRequest $request)
    {
        try {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            $point = Point::createPoint($latitude, $longitude);

            return response()->json($point);

        } catch (Throwable $t) {
            Log::error($t);

            return response()->json();
        }
    }
}
