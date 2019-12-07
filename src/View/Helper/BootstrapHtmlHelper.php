<?php

namespace Bootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\HtmlHelper;

class BootstrapHtmlHelper extends HtmlHelper {

    /**
     * @param array $config
     */
    public function initialize(array $config) {
        $this->helpers = $this->helpers + ['Url'];
    }

    /**
     * @param string|array $title
     * @param string|array|null $url
     * @param array $options
     * @return string
     */
    public function link($title, $url = null, array $options = []) {
        if (isset($options['redirectBack']) && $options['redirectBack'] === true) {
            $redirect = urlencode($this->Url->build(null, ['escape' => false]));
            if (isset($url['?'])) {
                if (!isset($url['?']['redirect'])) {
                    $url['?']['redirect'] = $redirect;
                } else {
                    $url['?'] = Hash::merge($url['?'], ['redirect' => $redirect]);
                }
            } else {
                $url['?']['redirect'] = $redirect;
            }
            unset($options['redirectBack']);
        }
        if (isset($options['useRedirect']) && $options['useRedirect'] === true) {
            $redirect = $this->getView()->getRequest()->getParam('redirect');
            if (!empty($redirect)) {
                $url = urldecode($redirect);
            }
            unset($options['useRedirect']);
        }
        if (!isset($options['data-toggle'])) {
            $options['data-toggle'] = 'tooltip';
        }
        return parent::link($title, $url, $options);
    }

    /**
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
     * @param string|array $title
     * @param string|array|null
     * @param array $optionsLink
     * @param array $optionsList
     * @return string
     */
    public function linkNavItem($title, $url = null, array $optionsLink = [], array $optionsList = []) {
        $isCurrent = $this->isCurrent($url);
        $optionsList['class'] = 'nav-item';
        if ($isCurrent) {
            $optionsList['class'] .= ' active';
            $url = '#';
        }
        $optionsLink['class'] = 'nav-link';
        return parent::tag('li', $this->link($title, $url, $optionsLink), $optionsList);
    }

    /**
     * @param string|array $title
     * @param string|array|null $url
     * @param array $optionsList
     * @param array $optionsLink
     * @return string
     */
    public function linkNavDropdownItem($title, $url = null, array $options = []) {
        $isCurrent = $this->isCurrent($url);
        $options['class'] = 'dropdown-item';
        if ($isCurrent) {
            $options['class'] .= ' active';
            $url = '#';
        }
        return $this->link($title, $url, $options);
    }

    /**
     * @param string $text
     * @param array $options
     * @return string
     */
    public function span($text = null, array $options = []) {
        return $this->tag('span', $text, $options);
    }

    /**
     * @param string $text
     * @param array $options
     * @return string
     */
    public function button($text = null, array $options = []) {
        if (!isset($options['type'])) {
            $options['type'] = 'button';
        }
        if (!isset($options['class'])) {
            $options['class'] = 'btn btn-primary';
        }
        if (!isset($options['role'])) {
            $options['role'] = 'button';
        }
        return parent::tag('button', $text, $options);
    }

    /**
     * @param string $text
     * @param array $options
     * @return string
     */
    public function i($text = null, array $options = []) {
        return parent::tag('i', $text, $options);
    }

}
