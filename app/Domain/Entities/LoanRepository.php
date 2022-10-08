<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\EntityRepository;

class LoanRepository extends EntityRepository
{
    public function getByTitle(string $title): array|float|int|string
    {
        $qb = $this->createQueryBuilder('loan');

        $result = $qb->orWhere('LOWER(loan.title) LIKE :titlePart')
            ->setParameter(':titlePart', mb_strtolower("%{$title}%"))
            ->getQuery()
            ->getArrayResult();


        return $result;
    }
}
