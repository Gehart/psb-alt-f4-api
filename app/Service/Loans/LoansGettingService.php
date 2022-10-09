<?php

declare(strict_types=1);

namespace App\Service\Loans;

use App\Domain\Entities\Loan;
use App\Domain\Entities\LoanRepository;
use App\Service\Loans\DTO\LoansGettingRequestDTO;
use App\Service\Loans\DTO\LoansGettingResponseDTO;
use Doctrine\ORM\EntityManagerInterface;

class LoansGettingService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function getLoans(LoansGettingRequestDTO $requestDTO)
    {
        /** @var LoanRepository $loanRepository */
        $loanRepository = $this->entityManager->getRepository(Loan::class);

        $loans = $loanRepository->findBy([
            'typeOfPerson' => $requestDTO->getTypeOfPerson(),
            'typeOfLoan' => $requestDTO->getTypeOfLoan(),
            'customerCategory' => $requestDTO->getCustomerCategory(),
        ]);

        // TODO: prices
//        $loansPrices = [];
//        foreach ($loans as $loan) {
//
//        }

        return new LoansGettingResponseDTO($loans);
    }
}
