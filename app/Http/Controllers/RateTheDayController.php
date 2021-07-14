<?php

namespace App\Http\Controllers;

use App\attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateTheDayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $day = DB::table('day_rates')->where('day', $request->get('day'))->first();
        if (empty($day)) {
            $day = Auth::user()->day_rates()->create($request->all());
        } else {
            DB::table('day_rates')
                ->where('day', $request->get('day'))
                ->update(['attributes' => $request->get('attributes')]);
        }

        return response()->json($day);
    }

    public function check(Request $request)
    {
        $day = DB::table('day_rates')
            ->where('day', $request->get('date'))
            ->first();

        if (empty($day)) {
            return json_encode(['result' => ['true'], 'day' => date('d', strtotime($request->get('date')))]);
        } else {
            return json_encode(['result' => $day->attributes, 'day' => date('d', strtotime($day->day))]);
        }

    }

    public function index()
    {
        return view('ratetheday');
    }

}
