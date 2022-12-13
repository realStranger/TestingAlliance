<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\SetDeviceStateRequest;
use App\Http\Resources\DeviceStateResource;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceStateController extends ApiController
{
    /**
     * @param Device $device_id
     * @param Request $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function get(Device $device_id, Request $request): JsonResponse
    {
        $this->checkUserScope($device_id, $request);

        return $this->success(new DeviceStateResource($device_id->load('state')));
    }

    /**
     * @param Device $device_id
     * @param SetDeviceStateRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function set(Device $device_id, SetDeviceStateRequest $request): JsonResponse
    {
        $this->checkUserScope($device_id, $request);

        $deviceWithState = $device_id->load('state');
        $deviceWithState->state->update(['state' => (boolean)$request->validated()['state']]);

        return $this->success(new DeviceStateResource($deviceWithState));
    }

    /**
     * @param Device $device_id
     * @param Request $request
     * @return void
     * @throws ApiException
     */
    private function checkUserScope(Device $device_id, Request $request): void
    {
        $device = $device_id->userDevice()->where('user_id', $request->get('user')->id)->get();
        if ($device->isEmpty()){
            throw new ApiException('Device not found' , ApiException::VALIDATION_ERROR, 422);
        }
    }
}
