<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapHelperTest extends TestCase {

    /**
     * @var BootstrapHelper
     */
    public $Bootstrap;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->Bootstrap = new BootstrapHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->Bootstrap);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
