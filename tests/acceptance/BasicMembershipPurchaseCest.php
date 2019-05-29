<?php 
require_once("common.php");
class BasicMembershipPurchaseCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Basic Membership Purchase');
        $I->amOnPage('/');
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
         //click Join
         $I->waitForElementVisible(JOIN_BUTTON);
         $I->click(JOIN_BUTTON);
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Select basic plan
        $I->waitForElementVisible(CP_BASIC);
        $I->click(CP_BASIC);
        $I->waitForElementVisible('//a[text()="التالي"]'); 
        $I->click('//a[text()="التالي"]');

        //Fill the Your account details form
        $this->email='test'.mt_rand().'@gmail.com';
        $this->password="#Infoboyz123";
        $this->firstName="test";
        $this->lastName="test";
        $this->phone=9633977699;


        $I->waitForElementVisible('#usrfrm_email');

        $I->fillField('#usrfrm_email',$this->email);
        $I->fillField('#usrfrm_pass1',$this->password);
        $I->fillField('#usrfrm_pass2',$this->password);

        $I->executeJS("window.scrollTo(0,200);");
        $I->fillField('#usrfrm_firstname',$this->firstName);
        $I->fillField('#usrfrm_lastname',$this->lastName);
        $I->fillField('#usrfrm_phone',$this->phone);
        $I->waitForElementVisible('//a[text()="التالي"]'); 
        $I->click('//a[text()="التالي"]');
      //  
        $I->waitForElementVisible('//h2[text()="يرجى التحقق من طلبك"]');  // check for text "please check your order"
       // $I->waitForText('يرجى التحقق من طلبك');
        $I->see($this->email);
        $I->wait(2);

        $I->waitForElementVisible('//a[text()="التالي"]'); 
        $I->click('//a[text()="التالي"]');
        $I->wait(2);
   
        //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
        $I->waitForElementVisible('//h2[text()="'.MEMBERSHIP_PURCHASED_SUCCESSFULLY.'"]',15);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(1);

        //Login
        $I->amOnPage('/');
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        $I->fillField('username',$this->email);
        $I->fillField('password',$this->password);
        //Click Login
        $I->waitForElementVisible('//*[@id="edit-submit"]'); 
        $I->click('//*[@id="edit-submit"]');
        $I->wait(4);
        $I->executeJS("window.scrollTo(0,700);");
        $I->waitForElementVisible(LOGOUT_BUTTON);
        $I->waitForElementVisible(EDIT_PROFILE_BUTTON);  //EditProfile
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);

        //Check the Current MemberShip
        $I->see("البطاقة العادية"); //CP Basic
        $I->wait(3);
    }
}
