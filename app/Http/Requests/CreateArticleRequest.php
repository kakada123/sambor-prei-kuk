<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'form.category' => 'required',
            'form.name_en'  => (config('app.locale') == 'en') ? 'required' : 'nullable',
            'form.name_km'  => (config('app.locale') == 'km') ? 'required' : 'nullable',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new (response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
