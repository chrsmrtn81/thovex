<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePointRequest;
use App\Jobs\Api\StorePointJob;
use App\Models\Api\Point;
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

            StorePointJob::dispatch($latitude, $longitude);

            return response()->json(['message' => 'Point coordinates will be stored asynchronously.']);

        } catch (Throwable $t) {
            Log::error($t);

            return response()->json(['error' => 'Failed to store point coordinates.']);
        }
    }
}
