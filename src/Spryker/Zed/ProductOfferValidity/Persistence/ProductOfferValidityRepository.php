<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Persistence;

use Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

/**
 * @method \Spryker\Zed\ProductOfferValidity\Persistence\ProductOfferValidityPersistenceFactory getFactory()
 */
class ProductOfferValidityRepository extends AbstractRepository implements ProductOfferValidityRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer
     */
    public function getProductOfferValiditiesBecomingActive(): ProductOfferValidityCollectionTransfer
    {
        $productOfferValidityEntities = $this->getFactory()
            ->createProductOfferValidityPropelQuery()
            ->filterByValidFrom('now', Criteria::LESS_EQUAL)
            ->filterByValidTo('now', Criteria::GREATER_EQUAL)
            ->find();

        return $this->getFactory()
            ->createProductOfferValidityMapper()
            ->productOfferValidityEntitiesToProductOfferValidityCollectionTransfer(
                $productOfferValidityEntities,
                new ProductOfferValidityCollectionTransfer()
            );
    }

    /**
     * @return \Generated\Shared\Transfer\ProductOfferValidityCollectionTransfer
     */
    public function getProductOfferValiditiesBecomingInActive(): ProductOfferValidityCollectionTransfer
    {
        $productOfferValidityEntities = $this->getFactory()
            ->createProductOfferValidityPropelQuery()
            ->filterByValidFrom('now', Criteria::GREATER_THAN)
            ->_or()
            ->filterByValidTo('now', Criteria::LESS_THAN)
            ->find();

        return $this->getFactory()
            ->createProductOfferValidityMapper()
            ->productOfferValidityEntitiesToProductOfferValidityCollectionTransfer(
                $productOfferValidityEntities,
                new ProductOfferValidityCollectionTransfer()
            );
    }
}
