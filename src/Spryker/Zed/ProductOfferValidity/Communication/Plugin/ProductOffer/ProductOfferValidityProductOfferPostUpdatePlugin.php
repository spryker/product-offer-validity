<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Communication\Plugin\ProductOffer;

use Generated\Shared\Transfer\ProductOfferTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductOfferExtension\Dependency\Plugin\ProductOfferPostUpdatePluginInterface;

/**
 * @method \Spryker\Zed\ProductOfferValidity\ProductOfferValidityConfig getConfig()
 * @method \Spryker\Zed\ProductOfferValidity\Business\ProductOfferValidityFacadeInterface getFacade()
 */
class ProductOfferValidityProductOfferPostUpdatePlugin extends AbstractPlugin implements ProductOfferPostUpdatePluginInterface
{
    /**
     * {@inheritDoc}
     * - Updates existing Product Offer Validity entity in database if ProductOfferValidity transfer contains idProductOfferValidity property.
     * - Persists new Product Offer Validity entity to database if ProductOfferValidity transfer does not contain idProductOfferValidity property.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductOfferTransfer $productOfferTransfer
     *
     * @return \Generated\Shared\Transfer\ProductOfferTransfer
     */
    public function execute(ProductOfferTransfer $productOfferTransfer): ProductOfferTransfer
    {
        $productOfferValidityTransfer = $productOfferTransfer->getProductOfferValidity();

        if (!$productOfferValidityTransfer) {
            return $productOfferTransfer;
        }

        $productOfferValidityTransfer->setIdProductOffer($productOfferTransfer->getIdProductOffer());

        if (!$productOfferValidityTransfer->getIdProductOfferValidity()) {
            $productOfferValidityTransfer = $this->getFacade()->create($productOfferValidityTransfer);

            return $productOfferTransfer->setProductOfferValidity($productOfferValidityTransfer);
        }

        $productOfferValidityTransfer = $this->getFacade()->update($productOfferValidityTransfer);

        return $productOfferTransfer->setProductOfferValidity($productOfferValidityTransfer);
    }
}
