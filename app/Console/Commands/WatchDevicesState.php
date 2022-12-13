<?php

namespace App\Console\Commands;

use App\Models\Device;
use Illuminate\Console\Command;

class WatchDevicesState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'states:watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Watch state of all devices';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $device = Device::all()->load('state');
        foreach ($device as $item) {
            $this->info($item->name . ' - ' . $item->state->state);
        }
    }
}
