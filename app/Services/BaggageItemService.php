<?php

namespace App\Services;

use App\Models\BaggageItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaggageItemService
{
    public function create(array $data): BaggageItem
    {
        return DB::transaction(function () use ($data) {
            $data['bag_tag_number'] = strtoupper(
                trim($data['bag_tag_number'])
            );

            $data['heavy_cargo'] =
                (float) $data['bag_weight_kg'] > 32;

            return BaggageItem::create($data);
        });
    }

    public function update(int $id, array $data): BaggageItem
    {
        return DB::transaction(function () use ($id, $data) {
            $baggage = BaggageItem::findOrFail($id);

            $data['bag_tag_number'] = strtoupper(
                trim($data['bag_tag_number'])
            );

            $data['heavy_cargo'] =
                (float) $data['bag_weight_kg'] > 32;

            $baggage->update($data);

            return $baggage->refresh();
        });
    }
}
