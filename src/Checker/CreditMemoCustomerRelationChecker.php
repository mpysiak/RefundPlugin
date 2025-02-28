<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\RefundPlugin\Checker;

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\RefundPlugin\Entity\CreditMemoInterface;
use Sylius\RefundPlugin\Exception\CreditMemoNotAccessible;

final class CreditMemoCustomerRelationChecker implements CreditMemoCustomerRelationCheckerInterface
{
    public function __construct(
        private readonly CustomerContextInterface $customerContext,
        private readonly RepositoryInterface $creditMemoRepository,
    ) {
    }

    public function check(string $creditMemoId): void
    {
        /** @var CreditMemoInterface $creditMemo */
        $creditMemo = $this->creditMemoRepository->find($creditMemoId);

        /** @var OrderInterface $order */
        $order = $creditMemo->getOrder();

        /** @var CustomerInterface $orderCustomer */
        $orderCustomer = $order->getCustomer();

        /** @var CustomerInterface $customer */
        $customer = $this->customerContext->getCustomer();

        if ($orderCustomer->getId() !== $customer->getId()) {
            throw CreditMemoNotAccessible::withUserId($creditMemoId, $customer->getId());
        }
    }
}
