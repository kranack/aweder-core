<?php

namespace App\Http\Requests\Registration;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessDetailsRequest extends FormRequest
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
            //'logo' => ['image'],
            'name' => ['required'],
            'description' => ['required', new MaxWordsRule(100)],
            'url_slug' => ['required', 'alpha_dash', 'unique:merchants,url_slug'],
            'collection_types' => ['required'],
            'collection_types.*' => [Rule::in(['table', 'delivery', 'collection'])],
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
