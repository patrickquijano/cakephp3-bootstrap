<?php

namespace Bootstrap\Test\TestCase\Controller\Component;

use Bootstrap\Controller\Component\BootstrapFlashComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

class BootstrapFlashComponentTest extends TestCase {

    /**
     * @var \Bootstrap\Controller\Component\BootstrapFlashComponent
     */
    public $BootstrapFlash;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->BootstrapFlash = new BootstrapFlashComponent($registry);
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
