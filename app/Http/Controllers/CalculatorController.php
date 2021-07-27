<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CalculatorController extends Controller
{
    public function index()
    {
        return Inertia::render('Calculator');
    }

    public function sum(Request $request)
    {
        $this->validate($request, [
            'first_number' => 'required|numeric',
            'second_number' => 'required|numeric'
        ]);

        return response()->json([
            'sum' => (float) $request->first_number + (float) $request->second_number
        ]);
    }
}
