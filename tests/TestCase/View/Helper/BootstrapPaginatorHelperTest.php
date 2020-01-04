<?php

namespace Bootstrap\Test\TestCase\View\Helper;

use Bootstrap\View\Helper\BootstrapPaginatorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BootstrapPaginatorHelperTest extends TestCase {

    /**
     * @var BootstrapPaginatorHelper
     */
    public $BootstrapPaginator;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $view = new View();
        $this->BootstrapPaginator = new BootstrapPaginatorHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown() {
        unset($this->BootstrapPaginator);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testInitialization() {
        $this->markTestIncomplete('Not implemented yet.');
    }

}
