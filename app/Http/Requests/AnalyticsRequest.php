<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyticsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page_views' => 'required|integer|min:0',
            'unique_visitors' => 'required|integer|min:0',
            'sales' => 'required|numeric|min:0',
            'conversion_rate' => 'required|numeric|min:0|max:1',
        ];
    }
}
