<?php

namespace App\Http\ApiV1\Modules\OrderDeliveries\Controllers;

use App\Actions\AddNewDeliveryAction;
use App\Actions\DeleteDeliveryAction;
use App\Actions\GetAllDeliveriesAction;
use App\Actions\GetDeliveryAction;
use App\Actions\SendStatusUpdateNotificationAction;
use App\Actions\UpdateDeliveryStatusAction;
use App\Http\Requests\PostDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;

class DeliveryInfosController
{
    public function index()
    {
        return GetAllDeliveriesAction::run();
    }

    public function post(PostDeliveryRequest $request)
    {
        $data = $request->validated();

        return AddNewDeliveryAction::run($data);
    }

    public function get(int $deliveryId)
    {
        return GetDeliveryAction::run($deliveryId);
    }

    public function update(int $deliveryId, UpdateDeliveryRequest $request)
    {
        $data = $request->validated();

        $updatedDelivery = UpdateDeliveryStatusAction::run($data, $deliveryId);
        SendStatusUpdateNotificationAction::run($updatedDelivery);

        return $updatedDelivery;
    }

    public function delete(int $deliveryId)
    {
        // TODO: add return
        DeleteDeliveryAction::run($deliveryId);
    }
}
