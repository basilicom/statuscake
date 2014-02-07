<?php

namespace StatusCake\Tests;

use StatusCake\Test;

class StatusCakeTest extends \PHPUnit_Framework_TestCase
{
    private $username, $token;

    protected function setUp()
    {

        // these two are set in the phpunit.xml!
        global $username, $token;

        $this->username = $username;
        $this->token    = $token;

        parent::setUp();
    }

    public function testCredentials()
    {
        if (is_null($this->username) || is_null($this->token)) {
            $this->markTestSkipped('User credentials missing');
        }
    }

    /**
     * @depends testCredentials
     */
    public function testGetTests()
    {
        $statusCake = new \StatusCake\Client($this->username, $this->token);

        $tests  = $statusCake->getTests();

        $this->assertTrue(is_array($tests));
    }

    /**
     * @depends testCredentials
     */
    public function testUpdateTest()
    {

        $this->markTestSkipped(
            'Creating a new Test skipped.'
        );
        return;

        $statusCake = new \StatusCake\Client($this->username, $this->token);

        $test = new Test();
        $test->websiteName = 'StatusCake PHPUnit TEST Entry';
        $test->websiteURL = 'http://google.de/';
        $test->findString = 'google';
        $test->checkRate = 60;
        $test->contactGroup = 'PagerDuty';

        $response  = $statusCake->updateTest($test);
        $this->assertTrue($response->Success);
    }

    /**
     * @depends testCredentials
     */
    public function testDeleteTest()
    {

        $this->markTestSkipped(
            'Deleting a Test skipped - need to provide a real TestID.'
        );
        return;

        $statusCake = new \StatusCake\Client($this->username, $this->token);

        $test = new Test();
        $test->testID = 108442;

        $response  = $statusCake->deleteTest($test);
        $this->assertTrue($response->Success);
    }


}