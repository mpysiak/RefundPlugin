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

namespace Sylius\RefundPlugin\Action\Admin;

use Sylius\RefundPlugin\Resolver\CreditMemoFileResolverInterface;
use Sylius\RefundPlugin\ResponseBuilder\CreditMemoFileResponseBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DownloadCreditMemoAction
{
    public function __construct(
        private readonly CreditMemoFileResolverInterface $creditMemoFileResolver,
        private readonly CreditMemoFileResponseBuilderInterface $creditMemoFileResponseBuilder,
        private readonly bool $hasEnabledPdfFileGenerator,
    ) {
    }

    public function __invoke(Request $request, string $id): Response
    {
        if (!$this->hasEnabledPdfFileGenerator) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $creditMemoPdfFile = $this->creditMemoFileResolver->resolveById($id);

        return $this->creditMemoFileResponseBuilder->build(Response::HTTP_OK, $creditMemoPdfFile);
    }
}
