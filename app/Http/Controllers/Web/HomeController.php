<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('pages.index');

        } catch (Throwable $t) {
            Log::error($t);

            abort(500);
        }
    }
}
