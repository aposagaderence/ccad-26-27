<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBaggageItemRequest;
use App\Http\Requests\UpdateBaggageItemRequest;
use App\Models\BaggageItem;
use App\Models\Flight;
use App\Models\Passenger;
use App\Services\BaggageItemService;

class BaggageItemController extends Controller
{
    public function __construct(
        private BaggageItemService $service
    ) {}

    public function index()
    {
        $baggage = BaggageItem::with([
            'passenger',
            'flight',
            'screeningLogs',
        ])->latest()->paginate(10);

        return response()->json($baggage);
    }

    public function create()
    {
        return response()->json([
            'passengers' => Passenger::select(
                'id', 'passenger_passport', 'passenger_name'
            )->get(),
            'flights' => Flight::select(
                'id', 'flight_code'
            )->get(),
        ]);
    }

    public function store(StoreBaggageItemRequest $request)
    {
        $baggage = $this->service->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Baggage item registered successfully.',
            'data' => $baggage->load(['passenger', 'flight']),
        ], 201);
    }

    public function update(
        UpdateBaggageItemRequest $request,
        $id
    ) {
        $baggage = $this->service->update(
            (int) $id,
            $request->validated()
        );

        return response()->json([
            'message' => 'Baggage item updated successfully.',
            'data' => $baggage->load(['passenger', 'flight']),
        ]);
    }
}