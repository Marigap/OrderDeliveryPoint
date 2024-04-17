<?php

namespace App\Http\ApiV1\Modules\OrderDeliveries\Controllers;

use App\Http\Requests\PostDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Models\ClientInfo;
use App\Models\DeliveryInfo;
use App\Models\OrderInfo;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Response;

class DeliveryInfosController
{
    public function index()
    {
        return DeliveryInfo::all();
    }

    public function post(PostDeliveryRequest $request)
    {
        $req_arr = $request->toArray();

        $client_info = $req_arr['client_info'];
        $new_client = ClientInfo::create([
            'client_name' => $client_info['client_name'],
            'phone' => $client_info['phone'],
            'email' => $client_info['email']
        ]);

        $order_info = $req_arr['order_info'];
        $new_order = OrderInfo::create(
            [
                "client_info_id" => $new_client->id,
                "order_name" => $order_info['order_name'],
                "weight" => $order_info['order_weight']
            ]);

        $new_delivery = DeliveryInfo::create(
            [
                "order_info_id" => $new_order->id,
                "status" => $req_arr['status'],
                "need_notify" => $req_arr['need_notify'],
                "current_location" => $req_arr['current_location'],
                "created_at" => $req_arr['created_at'],
                "updated_at" => $req_arr['updated_at']
            ]);

        return $new_delivery;
    }

    public function get(int $delivery_id)
    {
        return DeliveryInfo::findOrFail($delivery_id);
    }

    public function update(int $delivery_id, UpdateDeliveryRequest $request)
    {
        $req_arr = $request->toArray();
        $found_delivery = DeliveryInfo::findOrFail($delivery_id);

        $found_delivery->update(
            [
                "status" => $req_arr["status"],
                "current_location" => $req_arr["current_location"]
            ]);

        return $found_delivery;
    }

    public function delete(int $delivery_id)
    {
        echo DeliveryInfo::findOrFail($delivery_id);
        echo PHP_EOL;

        DeliveryInfo::findOrFail($delivery_id)->delete();
    }
}
