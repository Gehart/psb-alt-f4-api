<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="loan")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type_of_lending", type="string")
 * @ORM\DiscriminatorMap({
 *      "credit" = "App\Domain\Entities\Credit",
 *      "mortgage" = "App\Domain\Entities\Mortgage"
 * })
 */
abstract class Loan
{
    public const MORTGAGE_TYPE = 'mortgage';
    public const CREDIT_TYPE = 'credit';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** @ORM\Column(name="title", type="text") */
    private string $title;

    /** @ORM\Column(name="details", type="text") */
    private string $details;

    /**
     * Кредитная ставка
     * @ORM\Column(name="interest_rate", type="float")
     */
    private float $interestRate;

    /** @ORM\Column(name="max_sum", type="float", nullable=true) */
    private ?float $maxSum;

    /** @ORM\Column(name="max_term_in_years", type="integer") */
    private int $maxTermInYears;

    /** @ORM\Column(name="min_age", type="integer") */
    private ?int $minAge;

    /** @ORM\Column(name="customer_category", type="text") */
    private string $customerCategory;

    /** @ORM\Column(name="type_of_person", type="text") */
    private string $typeOfPerson;

    /** @ORM\Column(name="initial_payment_percent", type="float") */
    private float $initialPaymentPercent;

    /**
     * @param string $title
     * @param string $details
     * @param float $interestRate
     * @param float|null $maxSum
     * @param int $maxTermInYears
     * @param int|null $minAge
     * @param string $customerCategory
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
        string $typeOfPerson
    ) {
        $this->title = $title;
        $this->details = $details;
        $this->interestRate = $interestRate;
        $this->maxSum = $maxSum;
        $this->maxTermInYears = $maxTermInYears;
        $this->minAge = $minAge;
        $this->customerCategory = $customerCategory;
        $this->typeOfPerson = $typeOfPerson;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * @return float|null
     */
    public function getMaxSum(): ?float
    {
        return $this->maxSum;
    }

    /**
     * @return int
     */
    public function getMaxTermInYears(): int
    {
        return $this->maxTermInYears;
    }

    /**
     * @return int|null
     */
    public function getMinAge(): ?int
    {
        return $this->minAge;
    }

    /**
     * @return string
     */
    public function getCustomerCategory(): string
    {
        return $this->customerCategory;
    }

    /**
     * @return string
     */
    public function getTypeOfPerson(): string
    {
        return $this->typeOfPerson;
    }
}
