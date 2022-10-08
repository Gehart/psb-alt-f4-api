<?php

namespace App\Http\Controllers;

use App\Domain\Entities\CreditCard;
use App\Domain\Entities\CreditCardRepository;
use App\Domain\Entities\Loan;
use App\Domain\Entities\LoanRepository;
use App\Domain\Entities\Refinancing;
use App\Domain\Entities\RefinancingRepository;
use App\Http\Request\CreditProgramByNameRequest;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

class CreditProgramController extends Controller
{
    /**
     * @param CreditProgramByNameRequest $request
     * @param EntityManagerInterface $entityManager
     *
     * @return string
     */
    public function getCreditProgramByName(CreditProgramByNameRequest $request, EntityManagerInterface $entityManager): array
    {
        $titlePart = $request->get('title');

        /** @var LoanRepository $loanRepository */
        $loanRepository = $entityManager->getRepository(Loan::class);

        /** @var CreditCardRepository $creditCardRepository */
        $creditCardRepository = $entityManager->getRepository(CreditCard::class);

        /** @var RefinancingRepository $refinancingRepository */
        $refinancingRepository = $entityManager->getRepository(Refinancing::class);

//        $loanRepository->createQueryBuilder('qb')->expr()->like()
        $loans = $loanRepository->getByTitle($titlePart);

//        $expr = Criteria::expr()->contains('title', $titlePart);
//
//        $loans = $loanRepository->findBy([$expr]);
//        dd($loans);
        return $loans;
    }
}
