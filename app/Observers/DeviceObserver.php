<?php

namespace App\Observers;

use App\Models\Device;
use App\Models\DeviceState;

class DeviceObserver
{
    /**
     * Handle the Device "created" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function created(Device $device)
    {
        DeviceState::create([
            'device_id' => $device->id,
            'state' => true
        ]);
    }

    /**
     * Handle the Device "updated" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function updated(Device $device)
    {
        //
    }

    /**
     * Handle the Device "deleted" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function deleted(Device $device)
    {
        //
    }

    /**
     * Handle the Device "restored" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function restored(Device $device)
    {
        //
    }

    /**
     * Handle the Device "force deleted" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function forceDeleted(Device $device)
    {
        //
    }
}
