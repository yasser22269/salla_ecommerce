<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
             'name' => 'required|unique:attributes,name,'. $this->id,
           // 'name' => 'required',
           // "ar.name" => 'required|string',
           // "en.name" => 'required|string',

        ];
    }
}
