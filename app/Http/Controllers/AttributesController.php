<?php

namespace App\Http\Controllers;

use App\attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request)
    {
        $attributes = Auth::user()->attributes;
        return response()->json($attributes);
    }

    public function store(Request $request)
    {
        $attribute = Auth::user()->attributes()->create($request->all());
        return response()->json($attribute);
    }

    public function delete($id)
    {
        $attribute = attributes::find($id);
        if ($attribute->user_id == Auth::user()->id) {
            attributes::destroy($id);
            return response()->json("ok");
        } else {
            return response()->json("error");
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('attributes');
    }

}
