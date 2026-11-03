<?php

namespace App\Http\Controllers;

use App\Models\ScreeningGate;
use Illuminate\Http\Request;

class ScreeningGateController extends Controller
{
    public function index()
    {
        return ScreeningGate::with('screeningLogs')->paginate(10);
    }

    public function create()
    {
        return response()->json(['message' => 'Create screening gate']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gate_code' => 'required|string|unique:screening_gates,gate_code',
        ]);

        return response()->json(ScreeningGate::create($data), 201);
    }

    public function update(Request $request, ScreeningGate $screeningGate)
    {
        $data = $request->validate([
            'gate_code' => 'sometimes|required|string|unique:screening_gates,gate_code,' . $screeningGate->id,
        ]);

        $screeningGate->update($data);

        return response()->json($screeningGate);
    }
}
