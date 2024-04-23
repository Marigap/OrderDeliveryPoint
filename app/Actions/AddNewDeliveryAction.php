<?php

namespace App\Actions;

use App\Models\ClientInfo;
use App\Models\DeliveryInfo;
use App\Models\OrderInfo;
use Lorisleiva\Actions\Concerns\AsAction;

class AddNewDeliveryAction
{
    use AsAction;

    public function handle($data)
    {
        $clientInfo = $data['client_info'];
        $newClient = ClientInfo::create([
            'client_name' => $clientInfo['client_name'],
            'phone' => $clientInfo['phone'],
            'email' => $clientInfo['email'],
        ]);

        $orderInfo = $data['order_info'];
        $newOrder = OrderInfo::create(
            [
                "client_info_id" => $newClient->id,
                "order_name" => $orderInfo['order_name'],
                "weight" => $orderInfo['order_weight'],
            ]
        );

        return DeliveryInfo::create(
            [
                "order_info_id" => $newOrder->id,
                "need_notify" => $data['need_notify'],
                "status" => $data['status'],
                "current_location" => $data['current_location'],
            ]
        );
    }
}
