<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\DeviceState;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\UserToken;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(rand(7,15))->create();

        foreach ($users as $user) {
            Device::factory()
                ->has(UserDevice::factory()->state(['user_id' => $user->id]), 'userDevice')
//                ->has(DeviceState::factory(), 'state')
                ->create();

            UserToken::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
