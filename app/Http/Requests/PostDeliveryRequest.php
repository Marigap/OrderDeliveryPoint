<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: maybe add additional parameter is_admin in order
        // to check that only when is_admin = true update will be applied
        // also for delete.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "client_info.client_name" => "required",
            "client_info.phone" => "required|unique:client_infos,phone|regex:/7\d{10}/",
            "client_info.email" => "required|unique:client_infos,email|email",
            "order_info.order_name" => "required",
            "order_info.order_weight" => "required",
            "status" => "required|in:accepted,processing,in_transit,delivered,picked_up",
            "current_location" => "required",
            "need_notify" => "required",
            "created_at" => "required",
            "updated_at" => "required",
        ];
    }
}
