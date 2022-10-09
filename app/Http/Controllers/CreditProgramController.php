<?php

namespace App\Http\Controllers;

use App\Domain\Entities\CreditCard;
use App\Domain\Entities\CreditCardRepository;
use App\Domain\Entities\Loan;
use App\Domain\Entities\LoanRepository;
use App\Domain\Entities\Refinancing;
use App\Domain\Entities\RefinancingRepository;
use App\Http\Request\CategoriesGettingRequest;
use Doctrine\ORM\EntityManagerInterface;

class CreditProgramController extends Controller
{
    /**
     * @param CategoriesGettingRequest $request
     * @param EntityManagerInterface $entityManager
     *
     * @return string
     */
    public function getCreditProgramByName(CategoriesGettingRequest $request, EntityManagerInterface $entityManager): array
    {
        $titlePart = $request->get('title');

        /** @var LoanRepository $loanRepository */
        $loanRepository = $entityManager->getRepository(Loan::class);

        /** @var CreditCardRepository $creditCardRepository */
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


        return $this->groupLoanByCategories($loans);
    }

    /**
     * @param array<Loan> $loans
     *
     * @return array
     */
    private function groupLoanByCategories(array $loans): array
    {
        $groupedByCategoriesLoans = [];
        foreach ($loans as $loan) {
            $groupedByCategoriesLoans[$loan->getCustomerCategory()->getId()][] = $loan;
        }

        $categoriesInfo = [];
        foreach ($groupedByCategoriesLoans as $categoriesLoans) {
            $maxSum = 0;
            $maxTerm = 0;

            /** @var array<Loan> $categoriesLoans */
            foreach ($categoriesLoans as $loan) {
                if ($loan->getMaxSum() > $maxSum) {
                    $maxSum = $loan->getMaxSum();
                }

                if ($loan->getMaxTermInYears() > $maxTerm) {
                    $maxTerm = $loan->getMaxTermInYears();
                }
            }

//            Log::NOTICE('cc', $categoriesLoans);
            $currentCategory = $categoriesLoans[0]->getCustomerCategory();


            $categoriesInfo[] = [
                'customer_category_id' => $currentCategory->getId(),
                'name' => $currentCategory->getTitle(),
                'maxSum' => $maxSum,
                'maxTerm' => $maxTerm,
            ];

        }

        return [
            'categories' => $categoriesInfo,
        ];
    }
}
