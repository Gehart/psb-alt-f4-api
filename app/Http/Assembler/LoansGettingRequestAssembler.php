<?php

declare(strict_types=1);

namespace App\Http\Assembler;

use App\Domain\Entities\CustomerCategory;
use App\Domain\Entities\CustomerCategoryRepository;
use App\Http\Request\LoansGettingRequest;
use App\Service\Loans\DTO\LoansGettingRequestDTO;
use Doctrine\ORM\EntityManagerInterface;

class LoansGettingRequestAssembler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function create(LoansGettingRequest $request): LoansGettingRequestDTO
    {
        /** @var CustomerCategoryRepository $customerCategoryRepository */
        $customerCategoryRepository = $this->entityManager->getRepository(CustomerCategory::class);
        $customerCategory = $customerCategoryRepository->find($request->get('customer_category_id'));

        return new LoansGettingRequestDTO(
            $request->get('type_of_person'),
            $request->get('type_of_loan'),
            $customerCategory,
            (int) $request->get('term'),
            (float) $request->get('sum'),
        );
    }
}
