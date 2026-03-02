<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Business\Expander;

use Generated\Shared\Transfer\ProductOfferTransfer;
use Spryker\Zed\ProductOfferValidity\Persistence\ProductOfferValidityRepositoryInterface;

class ProductOfferExpander implements ProductOfferExpanderInterface
{
    /**
     * @var \Spryker\Zed\ProductOfferValidity\Persistence\ProductOfferValidityRepositoryInterface
     */
    protected $productOfferValidityRepository;

    public function __construct(ProductOfferValidityRepositoryInterface $productOfferValidityRepository)
    {
        $this->productOfferValidityRepository = $productOfferValidityRepository;
    }

    public function expandProductOfferWithProductOfferValidity(ProductOfferTransfer $productOfferTransfer): ProductOfferTransfer
    {
        $productOfferTransfer->requireIdProductOffer();

        $productOfferTransfer->setProductOfferValidity(
            $this->productOfferValidityRepository->findProductOfferValidityByIdProductOffer(
                $productOfferTransfer->getIdProductOffer(),
            ),
        );

        return $productOfferTransfer;
    }
}
