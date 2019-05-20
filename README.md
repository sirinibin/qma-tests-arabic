# QMA Tests
  This repository contains Acceptance tests for the QMA website written using Codeception framework configured with Selenium & Chrome Driver.
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

# Running Tests
```
php codecept.phar run --debug
```

# Running an Individual Test Example

```
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
