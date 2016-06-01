<?php
use \Step\Acceptance;

/**
 * @group test
 */
class TestCest
{

    function loginSuccess(Step\Acceptance\LoginSteps $I) {
        $I->loginSuccess('mowdirect@gmail.com','123456');
    }

    function selectBrandTwoBrands(\Step\Acceptance\CheckoutSteps $I){
        $I->selectBrandTwoBrands();
    }
    
    function checkOrderTractor(\Page\Checkout $checkoutPage)
    {
        $checkoutPage->checkOrder();
    }


}

