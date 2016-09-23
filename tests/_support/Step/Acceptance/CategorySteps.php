<?php
namespace Step\Acceptance;


use Exception;

/**
 * @property  assertGreaterOrEquals
 */
class CategorySteps extends \AcceptanceTester
{

    public function fullRange(){
        $I = $this;
        $I->click('//div[@class="category-collateral lawn-garden-tractors"]/div[' . rand(1, 2) . ']/div/a');
        $I->waitForElement('//*[@title="See our Full Range"]');
        $I->click('.curved.shadow.shop-now');
    }

    public function randomPanel ()
    {
        $I = $this;
        $topShow = '//div[@class="toolbar"]/div[@class="pager"]//select';
        $bottomShow = '//div[@class="toolbar-bottom"]//div[@class="pager"]//select';
        self::fullRange();
        $I->waitForElement('#top-limiter');
        $I->selectOption('#top-limiter', '25');
        $I->waitForAjax(10);
        $I->see('25', $topShow);
        $I->seeNumberOfElements('#products-list>li', [10,25]);
        $I->see('25',$bottomShow);

        $I->selectOption('#top-limiter', '50');
        $I->waitForAjax(10);
        $I->see('50', $topShow);
        $I->seeNumberOfElements('#products-list>li', [10,50]);
        $I->see('50',$bottomShow);

        $I->selectOption('#top-limiter', '10');
        $I->waitForAjax(10);
        $I->see('10', $topShow);
        $I->seeNumberOfElements('#products-list', [0,10]);
        $I->see('10',$bottomShow);
    }

    public function sortBy()
    {
        $I = $this;
        self::fullRange();
        $I->waitForElement('//div[@class="sort-by"]');
        $I->selectOption('//div[@class="sort-by"]//select', 'Name');
        $I->waitForAjax(10);
        $I->see('Name', 'div.sort-by');
        $name = $I->grabTextFrom('//*[@class="products-list"]/li[1]//h2/a');
        $name2 = $I->grabTextFrom('//*[@class="products-list"]/li[2]//h2/a');
        $n = substr($name, 0, 1);
        $n2 = substr($name2,0, 1);
        $this->assertGreaterOrEquals($n,$n2);

       $I->selectOption('//div[@class="sort-by"]//select', 'Price');
       $I->waitForAjax(10);
       $I->see('Price', 'div.sort-by');
       $price = $I->grabTextFrom('//*[@class="products-list"]/li[1]//span[@class="price"]');
       $price2 = $I->grabTextFrom('//*[@class="products-list"]/li[2]//span[@class="price"]');
       $pr = floatval(preg_replace("/[^0-9.]*/", '', $price));
       $pr2 = floatval(preg_replace("/[^0-9.]*/", '', $price2));
       $this->assertGreaterOrEquals($pr, $pr2);

    }
    
    public function paging()
    {
        $I = $this;
        self::fullRange();
        //$I->amOnPage('/lawn-garden-tractors/lawn-tractors/all-deals-4048');
        $I->waitForElement('//div[@class="pages"]');
        $pagingTop = count($I->grabMultiple('(//div[@class="pages"])[1]//li'));
        $I->waitForElementNotVisible('.previous.i-previous');
        $I->canSeeElement('.next.i-next');
        
        if ($pagingTop > 3) {

            for ($p = 2; $p < $pagingTop; $p++) {

                $I->click('(//div[@class="pages"])[1]//li[' . $p . ']');
                $I->waitForAjax(10);
                $I->waitForElementVisible('.previous.i-previous');
            }

            $I->click('//*[@class="pages"]//li[' . $p . ']');
            $I->waitForElementVisible('.previous.i-previous');
            $I->dontSeeElement('.next.i-next');
            $I->click('.previous.i-previous');
            $I->waitForAjax(10);
            $I->click('(//div[@class="pages"])[1]//a[contains(text(),"1")]');
            $I->waitForAjax(10);
            
        } else {

            $I->click('(//div[@class="pages"])[1]//a[contains(text(),"2")]');
            $I->waitForAjax(10);
            $I->waitForElementVisible('.previous.i-previous');
            $I->click('.previous.i-previous');
            $I->waitForAjax(10);
        }

        
        $pagingBottom = count($I->grabMultiple('(//div[@class="pages"])[2]//li'));

        $I->waitForElementNotVisible('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
        $I->canSeeElement('(//div[@class="pages"])[2]//li/a[@title="Next"]');
        if ($pagingBottom > 3) {

            for ($p = 2; $p < $pagingBottom; $p++) {
                $I->click('(//div[@class="pages"])[2]//li[' . $p . ']');
                $I->waitForAjax(10);
                $I->waitForElementVisible('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
                $I->seeElement('(//div[@class="pages"])[2]//li/a[@title="Next"]');
            }
            $I->click('(//div[@class="pages"])[2]//li[' . $p . ']');
            $I->waitForElementVisible('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
            $I->dontSeeElement('(//div[@class="pages"])[2]//li/a[@title="Next"]');
            $I->click('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
            $I->waitForAjax(10);
            $I->click('(//div[@class="pages"])[2]//a[contains(text(),"1")]');
            $I->waitForAjax(10);
        } else {

            $I->click('(//div[@class="pages"])[2]//a[contains(text(),"2")]');
            $I->waitForAjax(10);
            $I->waitForElementVisible('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
            $I->click('(//div[@class="pages"])[2]//li/a[@title="Previous"]');
            $I->waitForAjax(10);
        }
    }






    

        

        


        


 



}