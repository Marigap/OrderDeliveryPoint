<?php

namespace App\Models;

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

}
