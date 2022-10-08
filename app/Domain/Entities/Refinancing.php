<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="refinancing")
 */
class Refinancing
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

    /** @ORM\Column(name="type_of_person", type="text") */
    private string $typeOfPerson;

    /**
     * @param string $title
     * @param string $details
     * @param string $typeOfPerson
     */
    public function __construct(string $title, string $details, string $typeOfPerson)
    {
        $this->title = $title;
        $this->details = $details;
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
     * @return string
     */
    public function getTypeOfPerson(): string
    {
        return $this->typeOfPerson;
    }
}
