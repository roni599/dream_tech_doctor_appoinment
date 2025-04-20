<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
            'medicine_name' => 'required|string|unique:medicines,medicine_name|max:255',
            'medicine_strength' => 'required|string|max:255',
            'dosages_description' => 'required|string|max:500',
            'medicine_group_id' => 'required|exists:medicine_groups,id',
        ];
    }
}
