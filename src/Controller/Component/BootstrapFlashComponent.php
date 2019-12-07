<?php

namespace Bootstrap\Controller\Component;

use Cake\Controller\Component\FlashComponent;

/**
 * @method void primary(string $message, array $options = [])
 * @method void secondary(string $message, array $options = [])
 * @method void success(string $message, array $options = [])
 * @method void danger(string $message, array $options = [])
 * @method void warning(string $message, array $options = [])
 * @method void info(string $message, array $options = [])
 * @method void light(string $message, array $options = [])
 * @method void dark(string $message, array $options = [])
 */
class BootstrapFlashComponent extends FlashComponent {

    /**
     * @param string $name
     * @param array $args
     * @return void
     */
    public function __call($name, $args) {
        if (!empty($args[1])) {
            $args[1] += ['plugin' => 'Bootstrap'];
        } else {
            $args[1] = ['plugin' => 'Bootstrap'];
        }
        parent::__call($name, $args);
    }

}
