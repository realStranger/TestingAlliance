<?php

namespace App\Services;

use App\DTO\DeviceDTO;
use App\Exceptions\ApiException;
use App\Models\Device;

class DeviceService
{
    private Device|null $device;

    /**
     * @param DeviceDTO $deviceDTO
     * @return mixed
     * @throws ApiException
     */
    public function add(DeviceDTO $deviceDTO)
    {
        $this->device = Device::firstWhere('login', $deviceDTO->getLogin());

        if (!empty($this->device)) {
            throw new ApiException('Device with this login already exists', ApiException::VALIDATION_ERROR, 422);
        }

        return Device::create([
            'login' => $deviceDTO->getLogin(),
            'password' => $deviceDTO->getPassword(),
            'name' => $deviceDTO->getName(),
        ]);
    }
}
