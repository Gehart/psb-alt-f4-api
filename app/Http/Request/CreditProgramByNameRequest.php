<?php

declare(strict_types=1);

namespace App\Http\Request;

class CreditProgramByNameRequest extends StandardRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|required',
        ];
    }
}
