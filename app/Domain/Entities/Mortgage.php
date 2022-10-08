<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Mortgage extends Loan
{

    /**
     * @param string $title
     * @param string $details
     * @param float $interestRate
     * @param float|null $maxSum
     * @param int $maxTermInYears
     * @param int|null $minAge
     * @param string $customerCategory
     * @param float $initialPaymentPercent
     * @param string $typeOfPerson
     */
    public function __construct(
        string $title,
        string $details,
        float $interestRate,
        ?float $maxSum,
        int $maxTermInYears,
        ?int $minAge,
        string $customerCategory,
        float $initialPaymentPercent,
        string $typeOfPerson
    ) {
        parent::__construct($title, $details, $interestRate, $maxSum, $maxTermInYears, $minAge, $customerCategory, $typeOfPerson);

        $this->initialPaymentPercent = $initialPaymentPercent;
    }

    /**
     * @return float
     */
    public function getInitialPaymentPercent(): float
    {
        return $this->initialPaymentPercent;
    }
}
