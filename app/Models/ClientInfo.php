<?php

namespace App\Models;

use _PHPStan_95cdbe577\React\Http\Client\Client;
use App\Http\Requests\PostDeliveryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['client_name', 'phone', 'email'];

    public function order_infos()
    {
        return $this->hasMany(OrderInfo::class);
    }

    /*
    public static function create(PostDeliveryRequest $request)
    {
        $new_client = new ClientInfo;
        $new_client = $request->client_name;
        $new_client = $request->phone;
        $new_client = $request->email;
        return $new_client;
    }
    */


}