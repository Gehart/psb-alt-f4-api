<?php

declare(strict_types=1);

namespace App\Http\Request;

class CategoriesGettingRequest extends StandardRequest
{
    public function rules(): array
    {
        return [
            'type_of_person' => 'string|required',
            'type_of_loan' => 'string|required',
        ];
    }
}
