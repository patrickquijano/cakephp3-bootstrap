<?php

namespace Bootstrap\View\Helper;

use Cake\View\Helper\FlashHelper;

class BootstrapFlashHelper extends FlashHelper {

    /**
     * @param string $key
     * @param array $options
     * @return string|null
     * @throws \UnexpectedValueException
     */
    public function render($key = 'flash', array $options = []) {
        $options['element'] = 'Bootstrap.Flash/default';
        return parent::render($key, $options);
    }

}
