<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductOfferValidity\Business;

use Codeception\Test\Unit;
use DateTime;
use Generated\Shared\Transfer\ProductOfferCriteriaFilterTransfer;
use Generated\Shared\Transfer\ProductOfferTransfer;
use Generated\Shared\Transfer\ProductOfferValidityTransfer;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductOfferValidity
 * @group Business
 * @group Facade
 * @group ProductOfferValidityFacadeTest
 * Add your own group annotations below this line
 */
class ProductOfferValidityFacadeTest extends Unit
{
    use LocatorHelperTrait;

    /**
     * @var \SprykerTest\Zed\ProductOfferValidity\ProductOfferValidityBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->tester->truncateProductOfferValidities();
    }

    /**
     * @return void
     */
    public function testCheckProductOfferValidityDateRange(): void
    {
        // Arrange
        $merchant = $this->tester->haveMerchant();

        $productOfferValid = $this->tester->haveProductOffer([
            ProductOfferTransfer::FK_MERCHANT => $merchant->getIdMerchant(),
            ProductOfferTransfer::IS_ACTIVE => false,
        ]);

        $productOfferInvalid = $this->tester->haveProductOffer([
            ProductOfferTransfer::FK_MERCHANT => $merchant->getIdMerchant(),
            ProductOfferTransfer::IS_ACTIVE => true,
        ]);

        $this->tester->haveProductOfferValidity([
            ProductOfferValidityTransfer::ID_PRODUCT_OFFER => $productOfferValid->getIdProductOffer(),
            ProductOfferValidityTransfer::VALID_FROM => (new DateTime('yesterday'))->format('Y-m-d H:i:s'),
            ProductOfferValidityTransfer::VALID_TO => (new DateTime('tomorrow'))->format('Y-m-d H:i:s'),
        ]);

        $this->tester->haveProductOfferValidity([
            ProductOfferValidityTransfer::ID_PRODUCT_OFFER => $productOfferInvalid->getIdProductOffer(),
            ProductOfferValidityTransfer::VALID_FROM => (new DateTime('yesterday'))->format('Y-m-d H:i:s'),
            ProductOfferValidityTransfer::VALID_TO => (new DateTime('yesterday'))->format('Y-m-d H:i:s'),
        ]);

        // Act
        $this->tester->getFacade()->checkProductOfferValidityDateRange();

        $productOfferCriteriaFilterTransfer = new ProductOfferCriteriaFilterTransfer();
        $productOfferCriteriaFilterTransfer->setIdProductOffer($productOfferValid->getIdProductOffer());
        $productOfferValid = $this->getLocator()->productOffer()->facade()->findOne($productOfferCriteriaFilterTransfer);

        $productOfferCriteriaFilterTransfer = new ProductOfferCriteriaFilterTransfer();
        $productOfferCriteriaFilterTransfer->setIdProductOffer($productOfferInvalid->getIdProductOffer());
        $productOfferInvalid = $this->getLocator()->productOffer()->facade()->findOne($productOfferCriteriaFilterTransfer);

        // Assert
        $this->assertTrue($productOfferValid->getIsActive());
        $this->assertFalse($productOfferInvalid->getIsActive());
    }
}
