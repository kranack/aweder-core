<?php

namespace App\Http\Requests\Api\Order;

use App\Contract\Repositories\OrderContract;
use App\Traits\RequestGetMerchantTrait;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStatusUpdateRequest extends FormRequest
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
        $orderRepository = app()->make(OrderContract::class);

        return [
            'merchant' => ['required'],
            'status' => ['required', Rule::in($orderRepository->getAllStatuses())]
        ];
    }
}
