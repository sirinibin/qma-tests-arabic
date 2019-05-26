<?php 
require_once("common.php");
class EditProfileCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;

    public function _before(AcceptanceTester $I)
    {
        // Register a new user account
        $I->amOnPage('/');
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(2);
        //click Join
         //click Join
        $I->waitForElementVisible('//a[text()="التسجيل"]');
        $I->click('//a[text()="التسجيل"]');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Select basic plan
        $I->waitForElementVisible(CP_BASIC);
        $I->click(CP_BASIC);
        //Click Next button
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

        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');

        $I->waitForElementVisible('//h2[text()="يرجى التحقق من طلبك"]');  // check for text "please check your order"
       // $I->waitForText('يرجى التحقق من طلبك');
        $I->see($this->email);
        $I->wait(2);

        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');
        $I->wait(4);
   
        //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
        $I->waitForElementVisible('//h2[text()="'.MEMBERSHIP_PURCHASED_SUCCESSFULLY.'"]');
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
    
        //Login
        $I->wantTo('Test Login');
        $I->amOnPage('/');
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        $I->fillField('username',$this->email);
        $I->fillField('password',$this->password);
        //Click Login
        $I->waitForElementVisible('//*[@id="edit-submit"]');
        $I->click('//*[@id="edit-submit"]');
        $I->wait(2);
        $I->waitForElementVisible('//a[text()="تسجيل الخروج"]');
        $I->waitForElementVisible('//a[text()="تعديل الملف الشخصي"]'); //EditProfile
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test تعديل الملف الشخصي');
        $I->waitForElementVisible('//a[text()="تعديل الملف الشخصي"]');
        $I->click('//a[text()="تعديل الملف الشخصي"]');
        $I->wait(4);
        $I->waitForElementVisible('//h2[text()="عدّل ملفك الشخصي / تعديل الملف الشخصي"]'); // check text: "your account details"
        
        $I->executeJS("window.scrollTo(0,300);");

        $this->phone=9633977690;
        $this->firstName=$this->firstName."-updated";
        $this->lastName=$this->lastName."-updated";

        $I->fillField('firstname',$this->firstName);
        $I->fillField('lastname',$this->lastName);
        
        $I->fillField('phone',$this->phone);

        $I->click("تحديث");
        
        $I->wait(4);
        $I->executeJS("window.scrollTo(0,300);");
        $I->see('Profile updated');
        $I->wait(4);

        //LogOut
        $I->amOnPage('/');
        $I->executeJS("window.scrollTo(0,900);");
        $I->wait(2);
        $I->click('//a[text()="تسجيل الخروج"]'); //Click LogOut
        $I->wait(4);
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->wait(4);

    }
}
