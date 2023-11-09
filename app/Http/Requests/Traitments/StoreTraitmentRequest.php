<?php

namespace App\Http\Requests\Traitments;

use Illuminate\Foundation\Http\FormRequest;

class StoreTraitmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:users,id'],
            'programmed_start_at' => ['required', 'date'],
            'programmed_end_at' => ['required', 'date'],
        ];
    }
}
