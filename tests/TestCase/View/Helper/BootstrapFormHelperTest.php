<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapFormHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapFormHelperTest extends TestCase {

    /**
     * @var BootstrapFormHelper
     */
    public $BootstrapForm;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->BootstrapForm = new BootstrapFormHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->BootstrapForm);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
