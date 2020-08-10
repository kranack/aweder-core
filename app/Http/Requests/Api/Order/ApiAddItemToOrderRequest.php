<?php

namespace App\Http\Requests\Api\Order;

use App\Traits\RequestGetMerchantTrait;
use Illuminate\Foundation\Http\FormRequest;

class ApiAddItemToOrderRequest extends FormRequest
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
            'inventory_id' => ['required', 'integer'],
            'variant_id' => ['required', 'integer'],
            'merchant' => ['required', 'string'],
            'inventory_options' => ['nullable', 'array']
        ];
    }
}
