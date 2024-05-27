<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiRequest extends FormRequest
{
    /** @return array<string, string[]> */
    abstract public function rules(): array;

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(
            ['errors' => $validator->errors()],
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
