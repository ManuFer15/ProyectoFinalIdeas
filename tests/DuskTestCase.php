<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;
use Symfony\Component\Process\Process;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Override the startChromeDriver method to use your custom path
     * This must be PUBLIC, not protected
     */
    public static function startChromeDriver(array $arguments = [])
    {
        // Your custom path to chromedriver
        $driverPath = 'C:\Users\34655\herd\idea\drivers\chromedriver.exe';

        // Start the ChromeDriver process
        static::$chromeDriverProcess = new Process(
            array_merge([$driverPath], $arguments)
        );

        static::$chromeDriverProcess->start();

        // Wait for the driver to start
        usleep(500000); // 0.5 seconds
    }

    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless=new', // Quita esta línea si quieres ver el navegador
            '--no-sandbox',
            '--disable-dev-shm-usage',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
