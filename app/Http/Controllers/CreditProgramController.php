<?php

namespace App\Http\Controllers;

use App\Domain\Entities\CreditCard;
use App\Domain\Entities\CustomerCategoryRepository;
use App\Domain\Entities\Loan;
use App\Domain\Entities\LoanRepository;
use App\Domain\Entities\Refinancing;
use App\Domain\Entities\RefinancingRepository;
use App\Http\Assembler\LoansGettingRequestAssembler;
use App\Http\Formatter\CustomerCategoriesFormatter;
use App\Http\Request\CategoriesGettingRequest;
use App\Http\Request\CreditProgramByNameRequest;
use App\Http\Request\LoansGettingRequest;
use App\Service\Loans\LoansGettingService;
use Doctrine\ORM\EntityManagerInterface;

class CreditProgramController extends Controller
{
    public function __construct(
        private CustomerCategoriesFormatter $formatter,
        private LoansGettingRequestAssembler $assembler,
    ) {
    }

    /**
     * @param CreditProgramByNameRequest $request
     * @param EntityManagerInterface $entityManager
     *
     * @return array
     */
    public function getCreditProgramByName(CreditProgramByNameRequest $request, EntityManagerInterface $entityManager): array
    {
        $titlePart = $request->get('title');

        /** @var LoanRepository $loanRepository */
        $loanRepository = $entityManager->getRepository(Loan::class);

        /** @var CustomerCategoryRepository $creditCardRepository */
        $creditCardRepository = $entityManager->getRepository(CreditCard::class);

        /** @var RefinancingRepository $refinancingRepository */
        $refinancingRepository = $entityManager->getRepository(Refinancing::class);

        $loans = $loanRepository->getByTitle($titlePart);

        return $loans;
    }

    public function getCustomerCategories(CategoriesGettingRequest $request, EntityManagerInterface $entityManager): array
    {
        $typeOfPerson = $request->get('type_of_person');
        $typeOfLoan = $request->get('type_of_loan');

        /** @var LoanRepository $loanRepository */
        $loanRepository = $entityManager->getRepository(Loan::class);

        $loans = $loanRepository->findBy([
            'typeOfPerson' => $typeOfPerson,
            'typeOfLoan' => $typeOfLoan,
        ]);


        return $this->formatter->format($loans);
    }

    public function getLoans(
        LoansGettingRequest $loansGettingRequest,
        LoansGettingService $loansGettingService
    ): array
    {
        $request = $this->assembler->create($loansGettingRequest);
        $loans = $loansGettingService->getLoans($request);

    }
}
