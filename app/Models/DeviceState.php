<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class DeviceState extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
