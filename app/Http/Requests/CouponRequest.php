<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            "code" => 'required|string',
            "type" => 'required',
            "discount" => 'required',
            "valid_from" => 'required|date|after_or_equal:today',
            "valid_to" => 'required|date|after_or_equal:valid_from',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'valid_from.after_or_equal' => 'The Valid From date must be today or a future date.',
            'valid_to.after_or_equal' => 'The Valid To date must be after or equal to Valid From date.',
        ];
    }
}
