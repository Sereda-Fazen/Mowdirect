<?php
use \Step\Acceptance;

/**
 * @group wishlist
 */
class MyWishListCest
{

    function T950AddAWishList(Step\Acceptance\EmailSteps $I, \Page\MyWishList $myWishList)
    {
        $I->loginSuccess('test_mowdirect@yahoo.co.uk', '123456');
        $myWishList->addItemsInWishlist();
    }
    function T948T954checkMyWishlist(Step\Acceptance\EmailSteps $I, \Page\MyWishList $myWishList)
    {
        $I->loginSuccess('test_mowdirect@yahoo.co.uk', '123456');
        $myWishList->wishList();
        $myWishList->checkItems();
        $myWishList->removeItemFromWishList();
        $myWishList->addComment();
        $myWishList->addShare();
        $I->loginEmail();
        $myWishList->removeItem();
    }







}
