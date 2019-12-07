<?php

namespace Bootstrap\View;

trait BootstrapViewTrait {

    /**
     * @param array $options
     * @return void
     */
    public function initializeBootstrap(array $options = []) {
        $this->loadHelper('Bootstrap.Bootstrap');
        $this->loadHelper('Html', ['className' => 'Bootstrap.BootstrapHtml']);
        $this->loadHelper('Flash', ['className' => 'Bootstrap.BootstrapFlash']);
        $this->loadHelper('Form', ['className' => 'Bootstrap.BootstrapForm']);
        $this->loadHelper('Paginator', ['className' => 'Bootstrap.BootstrapPaginator']);
    }

}
