<?php

namespace App\Http\Requests\Admin;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessDetailsEditRequest extends FormRequest
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
            'logo' => ['image'],
            'description' => ['required', new MaxWordsRule(100)],
            'customer-phone-number' => ['required'],
            'collection_types' => ['required'],
            'delivery_cost' => [
                Rule::requiredIf(function () {
                    return is_array(request()->get('collection_types')) &&
                        (in_array('delivery', request()->get('collection_types')));
                })
            ],
            'delivery_radius' => [
                Rule::requiredIf(function () {
                    return is_array(request()->get('collection_types')) &&
                        (in_array('delivery', request()->get('collection_types')));
                })
            ],
        ];
    }
}
