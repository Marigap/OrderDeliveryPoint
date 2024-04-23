<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
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
            "status" => "required|in:accepted,processing,in_transit,delivered,picked_up",
            "current_location" => "required",
        ];
    }
}
