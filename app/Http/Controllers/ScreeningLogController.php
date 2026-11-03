<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScreeningLogRequest;
use App\Http\Requests\UpdateScreeningLogRequest;
use App\Models\BaggageItem;
use App\Models\ScreeningGate;
use App\Models\ScreeningLog;
use App\Services\ScreeningLogService;

class ScreeningLogController extends Controller
{
    public function __construct(
        private ScreeningLogService $service
    ) {}

    public function index()
    {
        $logs = ScreeningLog::with([
            'baggageItem.passenger',
            'baggageItem.flight',
            'screeningGate',
        ])->latest()->paginate(10);

        return response()->json($logs);
    }

    public function create()
    {
        return response()->json([
            'baggage_items' => BaggageItem::select(
                'id', 'bag_tag_number', 'bag_weight_kg'
            )->get(),
            'screening_gates' => ScreeningGate::select(
                'id', 'gate_code'
            )->get(),
        ]);
    }

    public function store(StoreScreeningLogRequest $request)
    {
        $log = $this->service->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Screening log created successfully.',
            'data' => $log->load([
                'baggageItem.passenger',
                'baggageItem.flight',
                'screeningGate',
            ]),
        ], 201);
    }

    public function update(
        UpdateScreeningLogRequest $request,
        $id
    ) {
        $log = $this->service->update(
            (int) $id,
            $request->validated()
        );

        return response()->json([
            'message' => 'Screening log updated successfully.',
            'data' => $log->load([
                'baggageItem.passenger',
                'baggageItem.flight',
                'screeningGate',
            ]),
        ]);
    }
}