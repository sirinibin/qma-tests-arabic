<?php 

class GuestTicketPurchaseCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Guest User Ticket Purchase');
        // Land on home page and Press next button
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->see("WHEN WOULD YOU LIKE TO VISIT THE MUSEUM?");
        $I->wait(2);
        $I->click('next');
        $I->wait(2);

        //Select ticket types
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->waitForElementVisible("/html/body/section[2]/div/div/div[1]/div[2]/h2");
        $I->see('select tickets');
        $I->wait(2);
        $I->waitForElementVisible('//*[@id="list_tickets"]/div[1]/article/div/button[2]');
        $I->click('//*[@id="list_tickets"]/div[1]/article/div/button[2]');
        $I->wait(2);
        $I->click('next');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->waitForElementVisible('/html/body/section[2]/div/div/div[1]/div[3]/h2');
        $I->see("enter your information to receive tickets");
        $I->wait(2);
        
        $I->fillField('#qmatkt-firstname', "john");
        $I->fillField('#qmatkt-lastname', "Jhones");
        $I->fillField('#qmatkt-email', "john@gmail.com");
        $I->fillField('#qmatkt-phone', 9633977699);

        $I->wait(2);
        $I->click('next');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->see("please check your order");
        $I->wait(2);
        $I->click('next');
        //Select Master Card
        $I->waitForElementVisible('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img');
        $I->click('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img');
        
        $I->waitForElementVisible('#CardNumber');
        $I->fillField('#CardNumber',"5123456789012346");
        $I->fillField('#CardMonth','12');
        $I->fillField('#CardYear','21');
        $I->fillField('cardsecurecode','000');
        
        $I->click("#Paybutton");
        $I->waitForElementVisible('//*[@id="ContainerContent"]/center/form/table/tbody/tr[13]/td/input');
        $I->click("Submit");
        $I->waitForText("Please wait while your payment is processed",15);
        $I->waitForText("Your payment has been approved.",15);
        $I->executeJS("window.scrollTo(0,700);");
        $I->waitForElementVisible("//h2[text()='TICKET PURCHASED SUCCESFULLY!']",15);
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(5);
    }
}
