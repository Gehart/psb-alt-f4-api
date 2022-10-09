<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customer_category")
 */
class CustomerCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** @ORM\Column(name="title", type="text") */
    private string $title;

    /**
     * @var Collection<Loan>
     * @ORM\OneToMany(
     *     targetEntity="Loan",
     *     mappedBy="customerCategory",
     * )
     */
    private Collection $loans;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;

        $this->loans = new ArrayCollection();
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
     * @return Collection
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }
}
