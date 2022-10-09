<?php

declare(strict_types=1);

namespace App\Http\Formatter;

use App\Domain\Entities\Loan;
use App\Service\Loans\DTO\LoansGettingRequestDTO;
use App\Service\Loans\DTO\LoansGettingResponseDTO;
use Illuminate\Support\Facades\Log;

class LoansProductsFormatter
{
    public function format(LoansGettingResponseDTO $responseDTO, LoansGettingRequestDTO $request)
    {
        $formattedLoans = [];
        foreach ($responseDTO->getLoans() as $loan) {
            $formattedLoans[] = $this->formatLoanProduct($loan, $request);

        }

        $prices = $responseDTO->getPrices();
        foreach ($prices as $id => $price) {
            foreach ($formattedLoans as $formattedLoan) {
                if ($formattedLoan['id'] === $id) {
                    Log::notice('aa', [
                        $price,
                    ]);
                    $formattedLoan['amount_per_month'] = $price['amount_per_month'];
                }
            }
        }

        return [
            'products' => $formattedLoans,
        ];
    }

    private function formatLoanProduct(Loan $loan, LoansGettingRequestDTO $request)
    {
        $sum = $request->getSum();
        $interestRateByMonth = $loan->getInterestRate() / 100 / 12;
        $countOfMonth = $request->getTerm() * 12;

        $amountPerMonth = $sum * ($interestRateByMonth + ($interestRateByMonth / (pow((1 + $interestRateByMonth), $countOfMonth)  - 1)));

        return [
            'id' => $loan->getId(),
            'title' => $loan->getTitle(),
            'details' => $loan->getDetails(),
            'interest_rate' => $loan->getInterestRate(),
            'psb_url' => $loan->getPsbUrl(),
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
            'amount_per_month' => round($amountPerMonth, 2),
        ];
    }
}
