<?php

namespace StatusCake;

class Test
{
    const STATUS_UNKNOWN = null;
    const STATUS_UP = 'Up';
    const STATUS_DOWN = 'Down';

    const TYPE_HTTP = 'HTTP';
    const TYPE_PING = 'PING';
    const TYPE_TCP = 'TCP';

    /**
     * @var int|null
     */
    public $testID = null;  // null == new check | update, LISTED ON getTests()

    /**
     * @var int
     */
    public $paused = 0; // LISTED ON getTests()

    /**
     * @var string
     */
    public $websiteName = "UNSET"; // REQUIRED ON UPDATE, LISTED ON getTests()

    /**
     * @var string
     */
    public $websiteURL = "UNSET"; // REQUIRED ON UPDATE

    /**
     * @var int
     */
    public $public = 0; // LISTED ON getTests()

    /**
     * @var string
     */
    public $testType = self::TYPE_HTTP;  // HTTP,TCP,PING - REQUIRED ON UPDATE, LISTED ON getTests()

    /**
     * @var string|null
     */
    public $contactGroup = null; // e.g. "PagerDuty"; // LISTED ON getTests()

    /**
     * @var int|null
     */
    public $port = null;

    /**
     * @var int
     */
    public $timeout = 30;

    /**
     * @var null|string
     */
    public $pingURL = null;

    /**
     * @var int
     */
    public $checkRate = 300; // REQUIRED ON UPDATE

    /**
     * @var null|string
     */
    public $basicUser = null;

    /**
     * @var null|string
     */
    public $basicPass = null;

    /**
     * @var null|string
     */
    public $logoImage = null;

    /**
     * @var int
     */
    public $branding = 0; // 1 to disable branding

    /**
     * @var null|string
     */
    public $websiteHost = null;

    /**
     * @var int
     */
    public $virus = 0;

    /**
     * @var string|null
     */
    public $findString = null; //'SUCCESS';

    /**
     * @var int
     */
    public $doNotFind = 0; // 1 to trigger alert if found

    /**
     * @var int
     */
    public $realBrowser = 0; // 1 to enable real browser testing

    /**
     * @var int
     */
    public $triggerRate = 5; // minutes to wait before sending an alert

    /**
     * @var null|string
     */
    public $testTags = null;

    // theses are not in api settable? ... are returned by the list call =>

    /**
     * @var null|int
     */
    public $contactID = null; // LISTED ON getTests()

    /**
     * @var null|string
     */
    public $status = self::STATUS_UNKNOWN; // LISTED ON getTests()

    /**
     * @var null|int
     */
    public $uptime = null; // LISTED ON getTests()

}