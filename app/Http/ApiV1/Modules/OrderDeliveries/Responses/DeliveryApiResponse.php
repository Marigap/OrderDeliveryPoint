<?php

namespace App\Http\ApiV1\Modules\OrderDeliveries\Responses;

use Illuminate\Contracts\Support\Responsable;

class DeliveryApiResponse implements Responsable
{
    public function __construct(
        protected int $code,
        protected mixed $data,
        protected String $message,
    ) {}

    public function toResponse($request)
    {
        return response()->json([
            "data" => $this->data,
            "message" => $this->message,
        ])->SetStatusCode($this->code);
    }
}
