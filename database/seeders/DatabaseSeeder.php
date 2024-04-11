<?php

namespace Database\Seeders;

use App\Models\ClientInfo;
use App\Models\DeliveryInfo;
use App\Models\OrderInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ClientInfo::factory(5)->create()->each(
            function ($client) {
                $orders_num = random_int(1, 4);
                $orders = OrderInfo::factory($orders_num)->make();
                $client->order_infos()->saveMany($orders);
                $deliveries = DeliveryInfo::factory($orders_num)->make();
                for ($i = 0; $i < $orders_num; $i++) {
                    $orders[$i]->delivery_info()->save($deliveries[$i]);
                }
            }
        );
    }
}
