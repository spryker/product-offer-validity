<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferValidity\Persistence;

use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\ProductOfferValidity\Persistence\Propel\Mapper\ProductOfferValidityMapper;

/**
 * @method \Spryker\Zed\ProductOfferValidity\ProductOfferValidityConfig getConfig()
 * @method \Spryker\Zed\ProductOfferValidity\Persistence\ProductOfferValidityRepositoryInterface getRepository()
 */
class ProductOfferValidityPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery
     */
    public function createProductOfferValidityPropelQuery(): SpyProductOfferValidityQuery
    {
        return SpyProductOfferValidityQuery::create();
    }

    /**
     * @return \Spryker\Zed\ProductOfferValidity\Persistence\Propel\Mapper\ProductOfferValidityMapper
     */
    public function createProductOfferValidityMapper(): ProductOfferValidityMapper
    {
        return new ProductOfferValidityMapper();
    }
}
