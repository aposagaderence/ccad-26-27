<?php

namespace App\Services;

use App\Models\ScreeningLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ScreeningLogService
{
    public function create(array $data): ScreeningLog
    {
        return DB::transaction(function () use ($data) {
            $data = $this->sanitizeAndCheck($data);

            return ScreeningLog::create($data);
        });
    }

    public function update(int $id, array $data): ScreeningLog
    {
        return DB::transaction(function () use ($id, $data) {
            $log = ScreeningLog::findOrFail($id);

            $data = $this->sanitizeAndCheck($data);

            $log->update($data);

            return $log->refresh();
        });
    }

    private function sanitizeAndCheck(array $data): array
    {
        $data['screener_officer'] = trim(
            $data['screener_officer']
        );

        $reason = trim($data['flagged_reason'] ?? '');

        if ($data['screening_result'] === 'Failed' && $reason === '') {
            throw ValidationException::withMessages([
                'flagged_reason' =>
                    'A flagged reason is required when screening fails.',
            ]);
        }

        $data['flagged_reason'] = $reason !== ''
            ? $reason
            : null;

        // A failed screening must never be marked as cleared.
        if ($data['screening_result'] === 'Failed') {
            $data['clearance_status'] = 'Held';
        } else {
            $data['clearance_status'] ??= 'Pending';
        }

        return $data;
    }
}