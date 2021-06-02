<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\RefundPlugin\Exception;

final class CompletedPaymentNotFound extends \InvalidArgumentException
{
    public static function withNumber(string $orderNumber): self
    {
        return new self(sprintf('Order with number "%s" has no completed payments', $orderNumber));
    }
}
