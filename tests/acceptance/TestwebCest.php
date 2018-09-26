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
}
