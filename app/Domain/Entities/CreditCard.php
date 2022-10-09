<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CustomerCategoryRepository")
 * @ORM\Table(name="credit_card")
 */
class CreditCard
{
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

    /** @ORM\Column(name="min_age", type="integer") */
    private ?int $minAge;

    /** @ORM\Column(name="type_of_person", type="text") */
    private string $typeOfPerson;

    /**
     * @param string $title
     * @param string $details
     * @param int|null $minAge
     * @param string $typeOfPerson
     */
    public function __construct(string $title, string $details, ?int $minAge, string $typeOfPerson)
    {
        $this->title = $title;
        $this->details = $details;
        $this->minAge = $minAge;
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
     * @return int|null
     */
    public function getMinAge(): ?int
    {
        return $this->minAge;
    }

    /**
     * @return string
     */
    public function getTypeOfPerson(): string
    {
        return $this->typeOfPerson;
    }
}
