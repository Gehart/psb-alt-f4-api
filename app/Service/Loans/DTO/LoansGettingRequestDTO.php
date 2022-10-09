<?php

declare(strict_types=1);

namespace App\Service\Loans\DTO;

use App\Domain\Entities\CustomerCategory;

class LoansGettingRequestDTO
{
    public function __construct(
        private string $typeOfPerson,
        private string $typeOfLoan,
        private CustomerCategory $customerCategory,
        private int $term,
        private float $sum,
    ) {
    }

    /**
     * @return string
     */
    public function getTypeOfPerson(): string
    {
        return $this->typeOfPerson;
    }

    /**
     * @return string
     */
    public function getTypeOfLoan(): string
    {
        return $this->typeOfLoan;
    }

    /**
     * @return CustomerCategory
     */
    public function getCustomerCategory(): CustomerCategory
    {
        return $this->customerCategory;
    }

    /**
     * @return int
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }
}
