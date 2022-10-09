<?php

declare(strict_types=1);

namespace App\Http\Formatter;

use App\Domain\Entities\Loan;

class CustomerCategoriesFormatter
{
    /**
     * @param array<Loan> $loans
     *
     * @return array
     */
    public function format(array $loans)
    {
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
