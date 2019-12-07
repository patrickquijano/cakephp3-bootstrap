<?php

namespace Bootstrap\View;

trait BootstrapViewTrait {

    /**
     * @return void
     */
    public function initializeBootstrap() {
        $this->loadHelper('Bootstrap.Bootstrap');
        $this->loadHelper('Html', ['className' => 'Bootstrap.BootstrapHtml']);
        $this->loadHelper('Form', ['className' => 'Bootstrap.BootstrapForm']);
        $this->loadHelper('Paginator', ['className' => 'Bootstrap.BootstrapPaginator']);
        $this->loadHelper('Flash', ['className' => 'Bootstrap.BootstrapFlash']);
    }

}
