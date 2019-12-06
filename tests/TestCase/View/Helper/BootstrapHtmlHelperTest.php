<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapHtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapHtmlHelperTest extends TestCase {

    /**
     * @var \Bootstrap\View\Helper\BootstrapHtmlHelper
     */
    public $BootstrapHtml;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->BootstrapHtml = new BootstrapHtmlHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->BootstrapHtml);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
