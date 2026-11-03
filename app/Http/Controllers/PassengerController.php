<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        return Passenger::with('baggageItems')->paginate(10);
    }

    public function create()
    {
        return response()->json(['message' => 'Create passenger']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'passenger_passport' => 'required|string|unique:passengers,passenger_passport',
            'passenger_name' => 'required|string|max:255',
        ]);

        $data['passenger_passport'] = strtoupper(trim($data['passenger_passport']));

        return response()->json(Passenger::create($data), 201);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $data = $request->validate([
            'passenger_passport' => 'sometimes|required|string|unique:passengers,passenger_passport,' . $passenger->id,
            'passenger_name' => 'sometimes|required|string|max:255',
        ]);

        if (isset($data['passenger_passport'])) {
            $data['passenger_passport'] = strtoupper(trim($data['passenger_passport']));
        }

        $passenger->update($data);

        return response()->json($passenger);
    }
}
