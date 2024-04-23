<?php

namespace App\Actions;

use App\Models\DeliveryInfo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDeliveryAction
{
    use AsAction;

    public function handle($deliveryId)
    {
        return DeliveryInfo::findOrFail($deliveryId)->delete();
    }
}
