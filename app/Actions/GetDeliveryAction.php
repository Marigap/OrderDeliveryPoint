<?php

namespace App\Actions;

use App\Models\DeliveryInfo;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDeliveryAction
{
    use AsAction;

    public function handle(int $deliveryId)
    {
        return DeliveryInfo::findOrFail($deliveryId);
    }
}
