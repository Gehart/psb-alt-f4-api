<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class LoanRepository extends EntityRepository
{
    public function getByTitle(string $title): array|float|int|string
    {
        $qb = $this->createQueryBuilder('loan');

        $result = $qb->Where('LOWER(loan.title) LIKE :titlePart')
            ->setParameter(':titlePart', mb_strtolower("%{$title}%"))
            ->getQuery()
            ->getArrayResult();


        return $result;
    }

    /**
     * @param string $typeOfLoan
     * @param string $typeOfPerson
     *
     * @return array<Loan>
     */
    public function getAvailableLoan(string $typeOfLoan, string $typeOfPerson): array
    {
        $qb = $this->createQueryBuilder('loan');

        /** @var array<Loan> $result */
        $result = $qb->join(CustomerCategory::class, 'cc', Join::WITH, 'loan.customerCategory = cc.id')
            ->where('loan.typeOfPerson = :typeOfPerson')
            ->andWhere('loan.typeOfLoan = :typeOfLoan')
            ->setParameter(':typeOfPerson', $typeOfPerson)
            ->setParameter(':typeOfLoan', $typeOfLoan)
            ->getQuery()
            ->getArrayResult();
        return $result;
    }
}
