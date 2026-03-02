<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Persistence;

use Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferValidityTransfer;

interface ProductOfferValidityRepositoryInterface
{
    public function getActivatableProductOffers(): ProductOfferValidityCollectionTransfer;

    public function getDeactivatableProductOffers(): ProductOfferValidityCollectionTransfer;

    public function findProductOfferValidityByIdProductOffer(int $idProductOffer): ?ProductOfferValidityTransfer;
}
