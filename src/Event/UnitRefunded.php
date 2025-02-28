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

namespace Sylius\RefundPlugin\Event;

class UnitRefunded implements UnitRefundedInterface
{
    public function __construct(
        private readonly string $orderNumber,
        private readonly int $unitId,
        private readonly int $amount,
    ) {
    }

    public function orderNumber(): string
    {
        return $this->orderNumber;
    }

    public function unitId(): int
    {
        return $this->unitId;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
