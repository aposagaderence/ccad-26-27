<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        return Flight::with('baggageItems')->paginate(10);
    }

    public function create()
    {
        return response()->json(['message' => 'Create flight']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_code' => 'required|string|unique:flights,flight_code',
        ]);

        return response()->json(Flight::create($data), 201);
    }

    public function update(Request $request, Flight $flight)
    {
        $data = $request->validate([
            'flight_code' => 'sometimes|required|string|unique:flights,flight_code,' . $flight->id,
        ]);

        $flight->update($data);

        return response()->json($flight);
    }
}
