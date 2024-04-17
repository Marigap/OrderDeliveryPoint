<?php

namespace App\Models;

use App\Http\Requests\PostDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInfo extends Model
{
    use HasFactory;

    protected $fillable = ['order_info_id', 'status', 'current_location',
                           'need_notify', 'updated_at', 'created_at'];

    public function order_info()
    {
        return $this->belongsTo(OrderInfo::class);
    }

    /*
    public static function create(PostDeliveryRequest $request, OrderInfo $orderInfo)
    {
        $new_delivery = new DeliveryInfo;
        $new_delivery->order_info_id = $orderInfo->id;
        $new_delivery->status = $request->status;
        $new_delivery->current_location = $request->current_location;
        $new_delivery->need_notify = $request->need_notify;
        $new_delivery->created_at = $request->created_at;
        $new_delivery->updated_at = $request->updated_at;
        return $new_delivery;
    }

    public function update(UpdateDeliveryRequest $request)
    {
        $this->status = $request->status;
        $this->current_location = $request->current_location;
    }
    */

}