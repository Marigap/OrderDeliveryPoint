<?php

namespace App\Actions;

use App\Models\DeliveryInfo;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllDeliveriesAction
{
    use AsAction;

    public function handle()
    {
        return DeliveryInfo::all();
    }
}
