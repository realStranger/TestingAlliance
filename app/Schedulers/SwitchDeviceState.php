<?php

namespace App\Schedulers;

use App\Models\Device;
use Illuminate\Support\Facades\Log;

class SwitchDeviceState
{
    public function __invoke()
    {
        $devicestate = Device::all()->load('state');
        foreach ($devicestate as $item) {
            $item->state->update(['state' => !$item->state->state]);
        }

        Log::channel('device-state')->info('Device states have been switched', ['count' => count($devicestate)]);
    }
}
