<?php

namespace Bootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\HtmlHelper;

/**
 * Bootstrap Html Helper
 */
class BootstrapHtmlHelper extends HtmlHelper {

    /**
     * Constructor hook method.
     *
     * Implement this method to avoid having to overwrite the constructor and call parent.
     *
     * @param array $config
     */
    public function initialize(array $config) {
        $this->helpers = Hash::merge($this->helpers, ['Url']);
        parent::initialize($config);
    }

    /**
     * Creates an HTML link.
     *
     * If $url starts with "http://" this is treated as an external link. Else,
     * it is treated as a path to controller/action and parsed with the
     * UrlHelper::build() method.
     *
     * If the $url is empty, $title is used instead.
     *
     * ### Options
     *
     * - `escape` Set to false to disable escaping of title and attributes.
     * - `escapeTitle` Set to false to disable escaping of title. Takes precedence
     *   over value of `escape`)
     * - `confirm` JavaScript confirmation message.
     * - `includeRedirect` Includes a redirect query param for the current url.
     * - `useRedirect` Uses redirect in the query param as a URL if it exists.
     *
     * @param string|array $title The content to be wrapped by `<a>` tags.
     *   Can be an array if $url is null. If $url is null, $title will be used as both the URL and title.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of options and HTML attributes.
     * @return string An `<a />` element.
     */
    public function link($title, $url = null, array $options = []) {
        if (isset($options['includeRedirect']) && $options['includeRedirect'] === true) {
            $redirect = urlencode($this->Url->build(null, ['escape' => false]));
            if (is_array($url)) {
                $url = Hash::merge($url, ['?' => ['redirect' => $redirect]]);
            }
            unset($options['includeRedirect']);
        }
        if (isset($options['useRedirect']) && $options['useRedirect'] === true) {
            $redirect = $this->getView()->getRequest()->getQuery('redirect');
            if (!empty($redirect)) {
                $url = urldecode($redirect);
            }
            unset($options['useRedirect']);
        }
        if (!isset($options['data-toggle'])) {
            $options = Hash::merge($options, ['data-toggle' => 'tooltip']);
        }
        return parent::link($title, $url, $options);
    }

    /**
     * Checks if the passed value is a current URL.
     *
     * @param string|array $url
     * @return bool
     */
    public function isCurrent($url) {
        $request = $this->getView()->getRequest();
        $isCurrent = true;
        if (is_array($url)) {
            foreach ($url as $key => $value) {
                if (is_array($value)) {
                    $isCurrent = $this->isCurrent($value);
                }
                if ($request->getParam($key) != $value) {
                    $isCurrent = false;
                }
            }
        } else {
            if ($url !== $request->getRequestTarget()) {
                $isCurrent = false;
            }
        }
        return $isCurrent;
    }

    /**
     * An extension of link method. Generates a link for Bootstrap nav item.
     *
     * @param string|array $title The content to be wrapped by `<a>` tags.
     *   Can be an array if $url is null. If $url is null, $title will be used as both the URL and title.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $optionsLink Array of options and HTML attributes for the link.
     * @param array $optionsList Additional HTML attributes of the li tag.
     * @return string The formatted tag element with link tag.
     */
    public function linkNavItem($title, $url = null, array $optionsLink = [], array $optionsList = []) {
        $isCurrent = $this->isCurrent($url);
        $linkClass = 'nav-link';
        if (isset($optionsLink['class'])) {
            $linkClass .= ' ' . $optionsLink['class'];
        }
        $optionsLink = Hash::merge($optionsLink, ['class' => $linkClass]);
        $listClass = 'nav-item';
        if ($isCurrent) {
            $listClass .= ' active';
            $url = '#';
        }
        if (isset($optionsList['class'])) {
            $listClass .= ' ' . $optionsList['class'];
        }
        $optionsList = Hash::merge($optionsList, ['class' => $listClass]);
        return parent::tag('li', $this->link($title, $url, $optionsLink), $optionsList);
    }

    /**
     * An extension of link method. Generates a link for Bootstrap nav dropdown item.
     *
     * @param string|array $title The content to be wrapped by `<a>` tags.
     *   Can be an array if $url is null. If $url is null, $title will be used as both the URL and title.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of options and HTML attributes for the link.
     * @return string An `<a />` element.
     */
    public function linkNavDropdownItem($title, $url = null, array $options = []) {
        $isCurrent = $this->isCurrent($url);
        $class = 'dropdown-item';
        if ($isCurrent) {
            $class .= ' active';
            $url = '#';
        }
        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $options = Hash::merge($options, ['class' => $class]);
        return $this->link($title, $url, $options);
    }

    /**
     * Returns a formatted block tag <span>.
     *
     * ### Options
     *
     * - `escape` Whether or not the contents should be html_entity escaped.
     *
     * @param string|null $text String content that will appear inside the tag element.
     *   If null, only a start tag will be printed
     * @param array $options Additional HTML attributes of the <span> tag, see above.
     * @return string The formatted tag <span> element
     */
    public function span($text = null, array $options = []) {
        return $this->tag('span', $text, $options);
    }

    /**
     * Returns a formatted block tag <button>.
     *
     * ### Options
     *
     * - `escape` Whether or not the contents should be html_entity escaped.
     *
     * @param string|null $text String content that will appear inside the tag element.
     *   If null, only a start tag will be printed
     * @param array $options Additional HTML attributes of the <button> tag, see above.
     * @return string The formatted tag <button> element
     */
    public function button($text = null, array $options = []) {
        if (!isset($options['type'])) {
            $options = Hash::merge($options, ['type' => 'button']);
        }
        $class = 'btn btn-primary';
        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $options = Hash::merge($options, ['class' => $class]);
        if (!isset($options['role'])) {
            $options = Hash::merge($options, ['role' => 'button']);
        }
        return parent::tag('button', $text, $options);
    }

    /**
     * Returns a formatted block tag <i>.
     *
     * ### Options
     *
     * - `escape` Whether or not the contents should be html_entity escaped.
     *
     * @param string|null $text String content that will appear inside the tag element.
     *   If null, only a start tag will be printed
     * @param array $options Additional HTML attributes of the <i> tag, see above.
     * @return string The formatted tag <i> element
     */
    public function i($text = null, array $options = []) {
        return parent::tag('i', $text, $options);
    }

}
