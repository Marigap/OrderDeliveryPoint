<?php

namespace App\Models;

use App\Http\Requests\PostDeliveryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['client_info_id', 'order_name', 'weight'];

    public function delivery_info()
    {
        return $this->hasOne(DeliveryInfo::class);
    }

    public function client_info()
    {
        return $this->belongsTo(ClientInfo::class);
    }

}