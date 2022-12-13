<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\AddDeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\GetUserDeviceResource;
use App\Models\UserDevice;
use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDeviceController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function get(Request $request): JsonResponse
    {
        $userDevice = UserDevice::where('user_id', $request->get('user')->id)->get();

        if ($userDevice->isEmpty()){
            throw new ApiException('Devices not found', ApiException::NOT_FOUND, 404);
        }

        $userDevice->load('device');

        return $this->success(['devices' => GetUserDeviceResource::collection($userDevice)]);
    }

    /**
     * @param AddDeviceRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function add(AddDeviceRequest $request): JsonResponse
    {
        $deviceService = new DeviceService();

        $device = $deviceService->add($request->getDto());

        UserDevice::create([
            'user_id' => $request->get('user')->id,
            'device_id' => $device->id
        ]);

        return $this->success(['device' => new DeviceResource($device)]);
    }
}
