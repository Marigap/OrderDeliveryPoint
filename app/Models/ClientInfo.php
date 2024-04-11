<?php

namespace App\Models;

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

}