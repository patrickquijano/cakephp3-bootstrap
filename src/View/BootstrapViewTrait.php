<?php

namespace Bootstrap\View;

/**
 * Bootstrap Trait
 */
trait BootstrapViewTrait {

    /**
     * Initializes the helpers for this plugin.
     * 
     * @return void
     */
    public function initializeBootstrap() {
        $this->loadHelper('Bootstrap.Bootstrap');
        $this->loadHelper('Html', ['className' => 'Bootstrap.BootstrapHtml']);
        $this->loadHelper('Form', ['className' => 'Bootstrap.BootstrapForm']);
        $this->loadHelper('Paginator', ['className' => 'Bootstrap.BootstrapPaginator']);
    }

}
