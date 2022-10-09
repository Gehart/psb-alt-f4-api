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
        private LoanCalculatingService $loanCalculatingService,
    ) {
    }

    public function getLoans(LoansGettingRequestDTO $requestDTO)
    {
        /** @var LoanRepository $loanRepository */
        $loanRepository = $this->entityManager->getRepository(Loan::class);

        $loans = $loanRepository->getAvailableLoan($requestDTO);

        $loansPrices = [];
        foreach ($loans as $loan) {
            $loansPrices = $this->loanCalculatingService->calculate($loan, $requestDTO);
        }

        return new LoansGettingResponseDTO($loans, $loansPrices);
    }
}
