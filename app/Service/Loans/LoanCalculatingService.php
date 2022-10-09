<?php

declare(strict_types=1);

namespace App\Service\Loans;

use App\Domain\Entities\Loan;
use App\Service\Loans\DTO\LoansGettingRequestDTO;
use Illuminate\Support\Facades\Log;

class LoanCalculatingService
{
    private const COUNT_OF_MONTH_IN_YEAR = 12;

    public function calculate(Loan $loan, LoansGettingRequestDTO $requestDTO): array
    {
        $term = $requestDTO->getTerm();
        $sum = $requestDTO->getSum();
        $countOfMonth = $term * self::COUNT_OF_MONTH_IN_YEAR;
//        $countOfMonth = $term;
        $interestRateByMonth = $loan->getInterestRate() / self::COUNT_OF_MONTH_IN_YEAR;

        Log::notice('formula', [
            'inbymo' => $interestRateByMonth,
        ]);
        $amountPerMonth = $sum * ($interestRateByMonth + ($interestRateByMonth / (pow((1 + $interestRateByMonth), $countOfMonth)  - 1)));
//        $amountPerMonth = $sum / (1 - pow(1 + $interestRateByMonth, -$countOfMonth));
        Log::notice('amount per month', [
            'id' => $loan->getId(),
            'rate' => $loan->getInterestRate(),
            'count' => $requestDTO->getSum(),
            'month' => $requestDTO->getTerm() * self::COUNT_OF_MONTH_IN_YEAR,
            'amountPerMonth' => $amountPerMonth,
        ]);
        return [
            $loan->getId() => [
                'amount_per_month'=> $amountPerMonth
            ]
        ];
    }
//х = S * (Р + (Р/(1+Р)N-1))
//в которой х — размер ежемесячного платежа
//Р — месячная процентная ставка (годовая ставка / 12)
//N – длительность кредита в месяцах

//х = S * (Р + (Р/(1+Р)N-1))
//
//в которой х — размер ежемесячного платежа
//Р — месячная процентная ставка (годовая ставка / 12)
//N – длительность кредита в месяцах
}
