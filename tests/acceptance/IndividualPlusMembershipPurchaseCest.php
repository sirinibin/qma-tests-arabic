<?php 

class IndividualPlusMembershipPurchaseCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Individual Plus Membership Purchase');
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(2);
        $I->click("join");
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");

        //Select IndividualPlus plan
        $I->waitForElementVisible('//*[@id="user-register-form"]/div/div[1]/div[2]/div[1]/div/a');
        $I->click('//*[@id="user-register-form"]/div/div[1]/div[2]/div[2]/div/a');
        $I->click('next');

        //Fill the Your account details form
        $email='test'.mt_rand().'@gmail.com';
        $password="123";
        $firstName="test";
        $lastName="test";
        $phone=9633977699;


        $I->waitForElementVisible('#usrfrm_email');

        $I->fillField('#usrfrm_email',$email);
        $I->fillField('#usrfrm_pass1',$password);
        $I->fillField('#usrfrm_pass2',$password);

        $I->executeJS("window.scrollTo(0,200);");
        $I->fillField('#usrfrm_firstname',$firstName);
        $I->fillField('#usrfrm_lastname',$lastName);
        $I->fillField('#usrfrm_phone',$phone);

        $I->click('next');
      //  
        $I->waitForElementVisible('//h2[text()="please check your order"]');
       // $I->waitForText('please check your order');
        $I->see($email);
        $I->wait(2);

        $I->click('next');
        $I->wait(2);
   
          //Select Master Card & Make Payment
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


        //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
        $I->waitForElementVisible('//h2[text()="MEMBERSHIP PURCHASED SUCCESSFULY!"]',15);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(1);

        //Check the Current MemberShip
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,900);");
        $I->see("CP Plus");
        $I->wait(6);

    }
}
