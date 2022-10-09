<?php

declare(strict_types=1);

namespace App\Service\Loans\DTO;

use App\Domain\Entities\Loan;

class LoansGettingResponseDTO
{
    /**
     * @param array<Loan> $loans
     */
    public function __construct(
        private array $loans,
    ) {
    }

    /**
     * @return array<Loan>
     */
    public function getLoans(): array
    {
        return $this->loans;
    }
}
