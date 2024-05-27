<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class ItemListRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'string'
        ];
    }
}
