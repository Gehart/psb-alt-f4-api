<?php

declare(strict_types=1);

namespace App\Domain\Entities;

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
    private Collection $loan;
}
