<?php

namespace App\Actions;

use App\Models\ClientInfo;
use App\Models\OrderInfo;
use Exception;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class SendStatusUpdateNotificationAction
{
    use AsAction;

    public function handle($updatedDelivery)
    {
        $orderInfo = OrderInfo::findOrFail($updatedDelivery->order_info_id);
        $clientInfo = ClientInfo::findOrFail($orderInfo->client_info_id);

        $deliveryStatus = $updatedDelivery->status;
        $needNotify = $updatedDelivery->need_notify;
        $alwaysNotifiedStatuses = ["accepted", "delivered", "picked_up"];

        $result = null;

        // TODO: add log
        if ($needNotify || in_array($deliveryStatus, $alwaysNotifiedStatuses)) {
            try {
                $result = Http::post("http://localhost:8081/api/v1/notifications", [
                    "client_info" => [
                        "client_name" => $clientInfo->client_name,
                        "phone" => $clientInfo->phone,
                        "email" => $clientInfo->email,
                    ],
                    "status_info" => [
                        "order_name" => $orderInfo->order_name,
                        "status" => $deliveryStatus,
                        "current_location" => $updatedDelivery->current_location,
                        "updated_at" => $updatedDelivery->updated_at,
                    ],
                ]);
            } catch (Exception $ex) {
                // TODO: fix exception processing and catching,
                // now failed connection to NotificationServer isn't to be caught
                echo $ex;
                echo PHP_EOL;
            }
        }

        // TODO: process it another way.
        return $result; // notification wasn't sent
    }
}
