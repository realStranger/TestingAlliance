<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userDevice()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function state()
    {
        return $this->hasOne(DeviceState::class);
    }
}
