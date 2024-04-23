<?php

namespace App\Actions;

use App\Models\DeliveryInfo;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateDeliveryStatusAction
{
    use AsAction;

    public function handle($data, $deliveryId)
    {
        $deliveryToUpdate = DeliveryInfo::findOrFail($deliveryId);
        $deliveryToUpdate->update(
            [
                "status" => $data["status"],
                "current_location" => $data["current_location"],
            ]
        );

        return $deliveryToUpdate;
    }
}
