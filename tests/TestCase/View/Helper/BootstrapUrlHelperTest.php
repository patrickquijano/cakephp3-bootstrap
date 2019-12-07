<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapUrlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapUrlHelperTest extends TestCase {

    /**
     *
     * @var \Bootstrap\View\Helper\BootstrapUrlHelper
     */
    public $BootstrapUrl;

    /**
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->BootstrapUrl = new BootstrapUrlHelper($view);
    }

    /**
     *
     * @return void
     */
    public function tearDown() {
        unset($this->BootstrapUrl);
        parent::tearDown();
    }

    /**
     *
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
