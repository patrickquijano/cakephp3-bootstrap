<?php

namespace Bootstrap\View\Helper;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;

/**
 * Bootstrap Helper
 *
 * @property HtmlHelper $Html
 */
class BootstrapHelper extends Helper {

    /**
     * Default configuration
     *
     * @var array
     */
    protected $_defaultConfig = [
        'css' => [
            'url' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
            'integrity' => 'sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh',
        ],
        'script' => [
            'url' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
            'integrity' => 'sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6',
        ],
    ];

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = ['Html'];

    /**
     * Creates a link element for Bootstrap CSS stylesheet.
     *
     * ### Usage
     *
     * Add the stylesheet to view block "css":
     *
     * ```
     * $this->Html->css(['block' => true]);
     * ```
     *
     * Add the stylesheet to a custom block:
     *
     * ```
     * $this->Html->css(['block' => 'layoutCss']);
     * ```
     *
     * ### Options
     *
     * - `block` Set to true to append output to view block "css" or provide
     *   custom block name.
     * - `plugin` False value will prevent parsing path as a plugin
     * - `rel` Defaults to 'stylesheet'. If equal to 'import' the stylesheet will be imported.
     * - `fullBase` If true the URL will get a full address for the css file.
     *
     * @param array $options Array of options and HTML arguments.
     * @return string|null CSS `<link />` or `<style />` tag, depending on the type of link.
     */
    public function css(array $options = []) {
        if (!isset($options['block'])) {
            $options = Hash::merge($options, ['block' => false]);
        }
        $options = Hash::merge($options, ['once' => true]);
        if (Configure::read('debug')) {
            return $this->Html->css('Bootstrap.bootstrap.min', $options);
        } else {
            $options = Hash::merge($options, [
                    'integrity' => $this->getConfig('css.integrity'),
                    'crossorigin' => 'anonymous',
            ]);
            return $this->Html->css($this->getConfig('css.url'), $options);
        }
    }

    /**
     * Returns Bootstrap `<script>` tag.
     *
     * ### Usage
     *
     * Add the script file to a custom block:
     *
     * ```
     * $this->Html->script('styles.js', ['block' => 'bodyScript']);
     * ```
     *
     * ### Options
     *
     * - `block` Set to true to append output to view block "script" or provide
     *   custom block name.
     * - `plugin` False value will prevent parsing path as a plugin
     * - `fullBase` If true the url will get a full address for the script file.
     *
     * @param string|string[] $url String or array of javascript files to include
     * @param array $options Array of options, and html attributes see above.
     * @return string|null String of `<script />` tags or null if block is specified in options
     *   or if $once is true and the file has been included before.
     */
    public function script(array $options = []) {
        if (!isset($options['block'])) {
            $options = Hash::merge($options, ['block' => false]);
        }
        $options = Hash::merge($options, ['once' => true]);
        if (Configure::read('debug')) {
            return $this->Html->script('Bootstrap.bootstrap.min', $options);
        } else {
            $options = Hash::merge($options, [
                    'integrity' => $this->getConfig('script.integrity'),
                    'crossorigin' => 'anonymous',
            ]);
            return $this->Html->script($this->getConfig('script.url'), $options);
        }
    }

}
