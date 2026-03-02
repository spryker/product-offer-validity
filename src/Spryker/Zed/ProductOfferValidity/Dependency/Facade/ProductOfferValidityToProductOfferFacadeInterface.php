<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Dependency\Facade;

use Generated\Shared\Transfer\ProductOfferCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferResponseTransfer;
use Generated\Shared\Transfer\ProductOfferTransfer;

interface ProductOfferValidityToProductOfferFacadeInterface
{
    public function update(ProductOfferTransfer $productOfferTransfer): ProductOfferResponseTransfer;

    public function get(ProductOfferCriteriaTransfer $productOfferCriteria): ProductOfferCollectionTransfer;
}
