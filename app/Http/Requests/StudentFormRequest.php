<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentFormRequest extends FormRequest
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
            'name' => [ 'required', 'string', 'max:50' ],
            'country_id' => [ 'required', Rule::exists('countries', 'id') ],
            'state_id' => [ 'required', Rule::exists('states', 'id') ],
            'qualification.*' => [ 'required' ],
            'year_of_passing.*' => [ 'required' ],
            'university.*' => [ 'required' ],
        ];
    }
}
