<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_email' => 'required|email',
            'partner_id'   => 'required|integer|exists:partners,id',
            'status'       => ['required', new EnumValue(OrderStatus::class, false)],
        ];
    }
}
