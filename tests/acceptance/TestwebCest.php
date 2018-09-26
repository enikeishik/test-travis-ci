<?php
class TestwebCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function testwebWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/testweb.html');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->see('test web content');
        $I->seeInTitle('test web title');
        $I->seeInSource('test web content');
    }
    
    public function testwebphpWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/testwebphp.php');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeInSource('test web PHP content');
    }
}
