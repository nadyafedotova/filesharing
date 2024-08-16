<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FileUploadRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            "file" => "required|file|max:102400"
        ];
    }

    final public function messages(): array
    {
        return parent::messages();
    }

    final protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "error" => 'The file may not be greater than 100 MB.'
        ], 422));
    }
}
