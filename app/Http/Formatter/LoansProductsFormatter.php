<?php

declare(strict_types=1);

namespace App\Http\Formatter;

use App\Domain\Entities\Loan;
use App\Service\Loans\DTO\LoansGettingResponseDTO;

class LoansProductsFormatter
{
    public function format(LoansGettingResponseDTO $responseDTO)
    {
        $formattedLoans = [];
        foreach ($responseDTO->getLoans() as $loan) {
            $formattedLoans[] = $this->formatLoanProduct($loan);

        }
        return [
            'products' => $formattedLoans,
        ];
    }

    private function formatLoanProduct(Loan $loan)
    {
        return [
            'id' => $loan->getId(),
            'details' => $loan->getDetails(),
            'interest_rate' => $loan->getInterestRate(),
            'maxSum' => $loan->getMaxSum(),
            'max_term_in_years' => $loan->getMaxTermInYears(),
            'min_age' => $loan->getMinAge(),
            'customer_category' => [
                'id' => $loan->getCustomerCategory()->getId(),
                'title' => $loan->getCustomerCategory()->getTitle(),
            ],
            'type_of_person' => $loan->getTypeOfPerson(),
            'type_of_loan' => $loan->getTypeOfLoan(),
            'initial_payment_percent' => $loan->getInitialPaymentPercent(),
        ];
    }
}
