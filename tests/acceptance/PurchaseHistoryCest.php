<?php 
require_once("common.php");
class PurchaseHistoryCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;
    public $ticketID;

    public function _before(AcceptanceTester $I)
    {
         // Register a new user account
         $I->amOnPage('/');
         $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
         $I->executeJS("window.scrollTo(0,500);");
         $I->wait(2);
         //click join
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
         $I->wait(2);
    
         //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
         $I->waitForElementVisible('//h2[text()="'.MEMBERSHIP_PURCHASED_SUCCESSFULLY.'"]');
         $I->executeJS("window.scrollTo(0,700);");
         $I->wait(2);

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
        $I->wait(2);
        $I->waitForElementVisible(LOGOUT_BUTTON);
        $I->waitForElementVisible(EDIT_PROFILE_BUTTON);   //EditProfile
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        //Purchase a ticket

        // Land on home page and Press next button
        $I->amOnPage('/');
        $I->see('حجز التذاكر الخاصة بك'); //check text ""BOOK YOUR TICKETS"
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');
        $I->wait(2);

        //Select ticket types
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->waitForElementVisible("/html/body/section[2]/div/div/div[1]/div[2]/h2");
        $I->see("اختر التذاكر"); // check text:"select tickets"
        $I->executeJS("window.scrollTo(0,800);");
        $I->wait(2);
        $I->waitForElementVisible(ADULT_TICKET);
        $I->click(ADULT_TICKET);
        
        $I->wait(2);
        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->waitForElementVisible('/html/body/section[2]/div/div/div[1]/div[3]/h2');
        $I->see("أدخل بياناتك"); // check text "enter your information to receive tickets"
        $I->wait(2);
        
        $I->fillField('#qmatkt-firstname', "john");
        $I->fillField('#qmatkt-lastname', "Jhones");
        $I->fillField('#qmatkt-email', "john@gmail.com");
        $I->fillField('#qmatkt-phone', 9633977699);

        $I->wait(2);
        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->see("يرجى التحقق من طلبك");
        $I->wait(2);
        //Click Next button
        $I->waitForElementVisible('//a[text()="التالي"]');
        $I->click('//a[text()="التالي"]');
        //Select Master Card
        $I->waitForElementVisible('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img',15);
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
        $I->waitForElementVisible("//h2[text()='".TICKET_PURCHASED_SUCCESSFULLY."']",15); //TICKET PURCHASED SUCCESFULLY!
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(2);
        $ticketIDString=$I->grabTextFrom('//*[@id="node-102"]/div/div/div/div/div/div/article[1]/span[2]');
        $ticketID=explode(" ", $ticketIDString);
        $this->ticketID=$ticketID[(count($ticketID)-1)];
        $I->wait(2);

    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Purchas History');
        $I->amOnPage('/purchase-history');
        $I->see($this->ticketID);
    }
}
