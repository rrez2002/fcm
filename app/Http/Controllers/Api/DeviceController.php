<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceCollection;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Annotation\Route;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return DeviceCollection
     * @Route("api/devices",methods=["GET"],name="devices.index")
     */
    public function index()
    {
        return new DeviceCollection(Auth::user()->devices()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeviceRequest $request
     * @return JsonResponse
     * @Route("api/devices",methods=["POST"],name="devices.store")
     */
    public function store(DeviceRequest $request)
    {
        $data = $request->validated();

        Auth::user()->devices()->create($data);

        return new JsonResponse(["message" => __("message.created", ["attribute" => __("device")])],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return JsonResponse
     * @Route("api/devices/{device}",methods=["DELETE"],name="devices.destroy")
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return new JsonResponse(["message" => __("message.deleted", ["attribute" => __("device")])],Response::HTTP_OK);
    }
}
