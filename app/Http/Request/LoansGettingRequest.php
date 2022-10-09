<?php

declare(strict_types=1);

namespace App\Http\Request;

class LoansGettingRequest extends StandardRequest
{
    public function rules(): array
    {
        return [
            'type_of_person' => 'string|required',
            'type_of_loan' => 'string|required',
            'customer_category_id' => 'int|required',
            'term' => 'int|required',
            'sum' => 'numeric|required',
        ];
    }
}
