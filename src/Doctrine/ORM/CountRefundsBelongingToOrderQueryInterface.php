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

namespace Sylius\RefundPlugin\Doctrine\ORM;

interface CountRefundsBelongingToOrderQueryInterface
{
    /** @param array<array-key, int> $unitRefundIds */
    public function count(array $unitRefundIds, string $orderNumber): int;
}
