<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to false if you want to restrict this request to authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slNo' => 'required|integer|max:100',
            'visit_date' => 'required',
            'department_category_id' => 'required|exists:departments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'nullable|string|max:255',
            'patient_mobile' => [
                'required',
                'string',
                'max:50',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^\+?[0-9]{10,15}$/', $value)) {
                        $fail('The ' . $attribute . ' must be a valid email or phone number.');
                    }
                },
            ],
            'patient_gender' => 'nullable|string|in:Male,Female,Others',
            'patient_age' => 'nullable|integer|min:0|max:120',
            'visit_time' => 'nullable',
            'payment' => 'nullable',
            'visit_reference_id' => 'nullable|exists:references,id',
            'visit_description' => 'nullable|string',
            'fee' => 'nullable|numeric|min:0',
            'amount' => 'nullable|numeric|min:0',
            'percentage' => 'nullable|numeric',
            'discount_reference_id' => 'nullable|exists:references,id',
            'discount_narration' => 'nullable|string',
            'free_reference_id' => 'nullable|exists:references,id',
            'free_narration' => 'nullable|string',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slNo.required' => 'The serial number is required.',
            'visit_date.required' => 'The visit date is required.',
            'visit_date.date_format' => 'The visit date must be in the format dd/mm/yyyy.',
            'department_category_id.required' => 'The department category is required.',
            'department_category_id.exists' => 'The selected department category does not exist.',
            'doctor_id.required' => 'The doctor is required.',
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'patient_name.string' => 'The patient name must be a string.',
            'patient_name.max' => 'The patient name may not be greater than 255 characters.',
            'patient_mobile.string' => 'The patient mobile must be a string.',
            'patient_mobile.max' => 'The patient mobile may not be greater than 15 characters.',
            'patient_gender.in' => 'The gender must be either male, female, or other.',
            'patient_age.integer' => 'The age must be a valid integer.',
            'patient_age.min' => 'The age must be at least 0.',
            'patient_age.max' => 'The age may not be greater than 120.',
            'visit_time.date_format' => 'The visit time must be in the format HH:MM.',
            'payment.numeric' => 'The payment must be a valid number.',
            'visit_reference_id.exists' => 'The selected visit reference does not exist.',
            'visit_description.string' => 'The visit description must be a string.',
            'fee.numeric' => 'The fee must be a valid number.',
            'amount.numeric' => 'The amount must be a valid number.',
            'percentage.numeric' => 'The percentage must be a valid number.',
            'percentage.max' => 'The percentage may not be greater than 100.',
            'discount_reference_id.exists' => 'The selected discount reference does not exist.',
            'discount_narration.string' => 'The discount narration must be a string.',
            'free_reference_id.exists' => 'The selected free reference does not exist.',
            'free_narration.string' => 'The free narration must be a string.',
        ];
    }
}
