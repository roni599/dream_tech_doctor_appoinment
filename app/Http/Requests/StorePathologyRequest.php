<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePathologyRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:pathologies,name',
            'price' => 'required|numeric|min:0',
            'pathology_category' => 'required|exists:pathology_categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The pathology name is required.',
            'name.unique' => 'This pathology already exists.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a valid number.',
            'pathology_category_id.required' => 'Please select a pathology category.',
            'pathology_category_id.exists' => 'Selected category does not exist.',
        ];
    }
}
