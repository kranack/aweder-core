<?php

namespace App\Http\Requests\Api\Order;

use App\Traits\RequestGetMerchantTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
{
    use RequestGetMerchantTrait;

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
    public function rules(): array
    {
        return [
            'merchant' => ['required', 'string'],
            'quantity' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'title' => ['nullable', 'string'],
            'inventory_options' => ['nullable', 'array']
        ];
    }
}
