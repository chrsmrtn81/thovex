<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Point;
use App\Jobs\Api\StorePointJob;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePointRequest;

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
