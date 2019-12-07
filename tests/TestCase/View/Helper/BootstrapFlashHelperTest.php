<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapFlashHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapFlashHelperTest extends TestCase {

    /**
     * @var \Bootstrap\View\Helper\BootstrapFlashHelper
     */
    public $BootstrapFlash;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->BootstrapFlash = new BootstrapFlashHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->BootstrapFlash);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
