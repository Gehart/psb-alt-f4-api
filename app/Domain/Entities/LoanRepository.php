<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Service\Loans\DTO\LoansGettingRequestDTO;
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
     * @param LoansGettingRequestDTO $requestDTO
     *
     * @return array<Loan>
     */
    public function getAvailableLoan(LoansGettingRequestDTO $requestDTO): array
    {
        $qb = $this->createQueryBuilder('loan');

        $qb->join(CustomerCategory::class, 'cc', Join::WITH, 'loan.customerCategory = cc.id')
            ->where('loan.typeOfPerson = :typeOfPerson')
                ->setParameter(':typeOfPerson', $requestDTO->getTypeOfPerson())
            ->andWhere('loan.customerCategory = :customerCategory')
                ->setParameter(':customerCategory', $requestDTO->getCustomerCategory())
            ->andWhere('loan.maxSum > :requestedSum')
                ->setParameter(':requestedSum', $requestDTO->getSum())
            ->andWhere('loan.maxTermInYears > :requestedTerm')
                ->setParameter(':requestedTerm', $requestDTO->getTerm());

        if ($requestDTO->getTypeOfLoan() === Loan::CREDIT_TYPE) {
            $qb->andWhere('loan.typeOfLoan = :typeOfLoan')
                ->setParameter(':typeOfLoan', $requestDTO->getTypeOfLoan());
        }

        /** @var array<Loan> $result */
        $result = $qb->getQuery()
            ->getResult();

        return $result;
    }
}
