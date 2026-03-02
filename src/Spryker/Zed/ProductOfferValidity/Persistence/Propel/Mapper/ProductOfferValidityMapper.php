<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferValidityTransfer;
use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity;
use Propel\Runtime\Collection\Collection;

class ProductOfferValidityMapper
{
    /**
     * @param \Propel\Runtime\Collection\Collection<mixed> $productOfferValidityEntities
     * @param \Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer $productOfferValidityCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer
     */
    public function productOfferValidityEntitiesToProductOfferValidityCollectionTransfer(
        Collection $productOfferValidityEntities,
        ProductOfferValidityCollectionTransfer $productOfferValidityCollectionTransfer
    ): ProductOfferValidityCollectionTransfer {
        foreach ($productOfferValidityEntities as $productOfferValidityEntity) {
            $productOfferValidityCollectionTransfer->addProductOfferValidity(
                $this->productOfferValidityEntityToProductOfferValidityTransfer(
                    $productOfferValidityEntity,
                    new ProductOfferValidityTransfer(),
                ),
            );
        }

        return $productOfferValidityCollectionTransfer;
    }

    public function productOfferValidityEntityToProductOfferValidityTransfer(
        SpyProductOfferValidity $productOfferValidityEntity,
        ProductOfferValidityTransfer $productOfferValidityTransfer
    ): ProductOfferValidityTransfer {
        $productOfferValidityTransfer->fromArray($productOfferValidityEntity->toArray(), true);
        $productOfferValidityTransfer->setIdProductOffer($productOfferValidityEntity->getFkProductOffer());

        return $productOfferValidityTransfer;
    }

    public function mapProductOfferValidityTransferToProductOfferValidityEntity(
        ProductOfferValidityTransfer $productOfferValidityTransfer,
        SpyProductOfferValidity $productOfferValidityEntity
    ): SpyProductOfferValidity {
        $productOfferValidityEntity->fromArray($productOfferValidityTransfer->toArray(false));
        $productOfferValidityEntity->setFkProductOffer($productOfferValidityTransfer->getIdProductOffer());

        return $productOfferValidityEntity;
    }
}
