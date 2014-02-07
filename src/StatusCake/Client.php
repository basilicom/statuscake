<?php

namespace StatusCake;

use Exception;

class Client
{
    /**
     * @var string
     */
    private $url = "https://www.statuscake.com/API";

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $token;

    public function __construct($username, $token)
    {
        $this->username = $username;
        $this->token = $token;
    }

    /**
     * Returns a list overview of all tests
     */
    public function getTests()
    {

        $response = $this->callApi('Tests');

        // Check for success
        if (!is_array($response)) {

            throw new Exception('StatusCake API Error - No list response on getTests.');
        }

        $testList = array();

        foreach ($response as $testData) {

            $testItem = new Test();

            foreach ($testData as $key => $testDataValue) {

                $testItem->{lcfirst($key)} = $testDataValue;
            }

            $testList[] = $testItem;
        }

        return $testList;
    }

    /**
     * updates or creates a test
     */
    public function updateTest(Test $test)
    {

        $data = array();

        // convert Test data to API structure
        foreach ($test as $key => $value) {

            if ($value != null) {

                $data[ucfirst($key)] = $value;
            }
        }

        $response = $this->callApi('Tests/Update', 'PUT', $data);

        // Check for success
        if (is_object($response) && ($response->Success == true)) {

            return $response;
        }

        throw new Exception('StatusCake API Error - Update failed.');

    }

    /**
     * deletes a test
     */
    public function deleteTest(Test $test)
    {
        if ((int)$test->testID == 0) {

            throw new Exception('Illegal Test/TestID.');
        }

        $response = $this->callApi(
            'Tests/Details/?TestID=' . (int)$test->testID,
            'DELETE'
        );

        // Check for success
        if (is_object($response) && ($response->Success == true)) {

            return $response;
        }

        throw new Exception('StatusCake API Error - Deleted failed.');
    }


    private function callApi($path, $method='GET', $data=null)
    {

        // Create the CURL String
        $ch = curl_init($this->url . '/' . $path);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Username: " . $this->username,
            "API: " . $this->token
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch) !== 0) {
            throw new Exception(curl_error($ch));
        }

        $response = json_decode($response);

        return $response;
    }

}