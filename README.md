# QMA Tests
  This repository contains Acceptance tests for the QMA website written using [Codeception framework](https://codeception.com) (PHP based) configured with [Selenium]( https://www.seleniumhq.org) & [Chrome Driver](http://chromedriver.chromium.org).
# Set Up

1.Download Standalone Selenium Server
  https://www.seleniumhq.org/download/

2.Download Chrome Web driver
 http://chromedriver.chromium.org/downloads

3.Start the chrome web driver
```
 cd to Download location
 ./chromedriver
```

4.Start Selenium Server
```
cd to Download location
./selenium-server-standalone-3.141.59.jar
```

5.Install PHP 7 

  Ubuntu: 
  ```
  sudo apt-get install software-properties-common
  sudo add-apt-repository ppa:ondrej/php
  sudo apt-get update
  sudo apt-get install -y php7.3
  ```

  Mac :
  ```
  curl -s http://php-osx.liip.ch/install.sh | bash -s 7.2
  ```


# Running Tests
```
cd qma-tests
php codecept.phar run --debug
```

# Running an Individual Test Example

```
cd qma-tests
php codecept.phar run tests/acceptance/LoginCest --debug
```

# Edit codeception.yml to update Web App URL & Browser settings
```
# suite config
suites:
    acceptance:
        actor: AcceptanceTester
        path: .
        modules:
            enabled:
                - WebDriver:
                    url: http://100.24.131.250/qma_test/qmaweb
                    window_size: 1280x1200
                    browser: chrome
                    pageload_timeout: 120

                - \Helper\Acceptance
                
extensions:
    enabled: [Codeception\Extension\RunFailed]
```
# Test Code Location
```
tests/acceptance
```

# References

1.https://codeception.com/docs/03-AcceptanceTests

2.https://www.seleniumhq.org/download/

3.http://chromedriver.chromium.org/downloads