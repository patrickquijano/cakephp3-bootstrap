<?php

namespace Bootstrap\Controller\Component;

use Cake\Controller\Component\FlashComponent;

/**
 * Bootstrap Flash component
 * 
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
     * Magic method for verbose flash methods based on element names.
     *
     * For example: $this->Flash->success('My message') would use the
     * success.ctp element under `src/Template/Element/Flash` for rendering the
     * flash message.
     *
     * If you make consecutive calls to this method, the messages will stack (if they are
     * set with the same flash key)
     *
     * Note that the parameter `element` will be always overridden. In order to call a
     * specific element from a plugin, you should set the `plugin` option in $args.
     *
     * For example: `$this->Flash->warning('My message', ['plugin' => 'PluginName'])` would
     * use the warning.ctp element under `plugins/PluginName/src/Template/Element/Flash` for
     * rendering the flash message.
     *
     * @param string $name Element name to use.
     * @param array $args Parameters to pass when calling `FlashComponent::set()`.
     * @return void
     * @throws \Cake\Http\Exception\InternalErrorException If missing the flash message.
     */
    public function __call($name, $args) {
        $options = [
            'plugin' => 'Bootstrap',
            'escape' => false,
        ];
        if (!empty($args[1])) {
            $args[1] += $options;
        } else {
            $args[1] = $options;
        }
        parent::__call($name, $args);
    }

}
