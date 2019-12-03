<?php

namespace Bootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\FormHelper;

class BootstrapFormHelper extends FormHelper {

    /**
     * @param array $config
     * @return void
     */
    public function initialize(array $config) {
        $defaultConfig = [
            'errorClass' => 'is-invalid',
            'templates' => [
                'checkboxContainer' => '<div class="form-check{{asdf}}">{{content}}</div>',
                'error' => '<div class="invalid-feedback">{{content}}</div>',
                'inputContainer' => '{{content}}{{help}}',
                'inputContainerError' => '{{content}}{{help}}{{error}}',
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                'radioContainer' => '{{content}}',
                'radioWrapper' => '<div class="form-check{{inline}}">{{label}}</div>',
                'submitContainer' => '{{content}}',
            ]
        ];
        $this->setConfig($defaultConfig);
    }

    /**
     * @param mixed $context The context for which the form is being defined.
     *   Can be a ContextInterface instance, ORM entity, ORM resultset, or an
     *   array of meta data. You can use false or null to make a context-less form.
     * @param array $options An array of html attributes and options.
     * @return string An formatted opening FORM tag.
     */
    public function create($context = null, array $options = []) {
        if (!isset($options['autocomplete'])) {
            $options['autocomplete'] = 'off';
        }
        return parent::create($context, $options);
    }

    /**
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string|array An HTML text input element.
     */
    public function checkbox($fieldName, array $options = array()) {
        if (!isset($options['class'])) {
            $options['class'] = 'form-check-input';
        }
        if ($options['class'] !== 'form-check-input') {
            $options['class'] = 'form-check-input ' . $options['class'];
        }
        if (!isset($options['id'])) {
            $options['id'] = $this->_domId($fieldName);
        }
        return parent::checkbox($fieldName, $options);
    }

    /**
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array|\Traversable $options Radio button options array.
     * @param array $attributes Array of attributes.
     * @return string Completed radio widget set.
     */
    public function radio($fieldName, $options = array(), array $attributes = array()) {
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'form-check-input';
        }
        if ($attributes['class'] !== 'form-check-input') {
            $attributes['class'] = 'form-check-input ' . $attributes['class'];
        }
        if (isset($attributes['inline'])) {
            if ($attributes['inline'] === true) {
                $attributes['templateVars']['inline'] = ' form-check-inline';
            }
            unset($attributes['inline']);
        }
        $attributes['hiddenField'] = isset($attributes['hiddenField']) ? $attributes['hiddenField'] : false;
        if (!isset($attributes['label']['class'])) {
            $attributes['label'] = [
                'class' => 'form-check-label',
            ];
        }
        if (!isset($options['id'])) {
            $options['id'] = $this->_domId($fieldName);
        }
        return parent::radio($fieldName, $options, $attributes);
    }

    /**
     * @param string $method Method name / input type to make.
     * @param array $params Parameters for the method call
     * @return string Formatted input method.
     */
    public function __call($method, $params) {
        $options = [];
        if (empty($params)) {
            throw new Exception(sprintf('Missing field name for FormHelper::%s', $method));
        }
        if (isset($params[1])) {
            $options = $params[1];
        }
        if (!isset($options['type'])) {
            $options['type'] = $method;
        }
        $options = $this->_initInputField($params[0], $options);
        if (!isset($options['class'])) {
            $options['class'] = 'form-control';
        }
        if ($options['class'] !== 'form-control') {
            $options['class'] = 'form-control ' . $options['class'];
        }
        if (isset($options['size'])) {
            switch ($options['size']) {
                case 'lg':
                    $options['class'] .= ' form-control-lg';
                    break;
                case 'sm':
                    $options['class'] .= ' form-control-sm';
                    break;
            }
            unset($options['size']);
        }
        return $this->widget($options['type'], $options);
    }

    /**
     * @param string $fieldName This should be "modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     */
    public function control($fieldName, array $options = array()) {
        if (isset($options['help'])) {
            $options['templateVars']['help'] = '<small class="form-text text-muted">' . $options['help'] . '</small>';
            unset($options['help']);
        }
        if (isset($options['type'])) {
            if ($options['type'] === 'checkbox') {
                if (!isset($options['label']['class'])) {
                    $options['label'] = [
                        'class' => 'form-check-label',
                    ];
                }
                if (isset($options['inline'])) {
                    if ($options['inline'] === true) {
                        $options['templateVars']['asdf'] = ' form-check-inline';
                    }
                    unset($options['inline']);
                }
            }
        }
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::control($fieldName, $options);
    }

    /**
     * @param string $fieldName Name of a field, in the form "modelname.fieldname"
     * @param array $options Array of HTML attributes, and special options above.
     * @return string A generated HTML text input element
     */
    public function textarea($fieldName, array $options = array()) {
        if (!isset($options['class'])) {
            $options['class'] = 'form-control';
        }
        if ($options['class'] !== 'form-control') {
            $options['class'] = 'form-control ' . $options['class'];
        }
        if (isset($options['size'])) {
            switch ($options['size']) {
                case 'lg':
                    $options['class'] .= ' form-control-lg';
                    break;
                case 'sm':
                    $options['class'] .= ' form-control-sm';
                    break;
            }
            unset($options['size']);
        }
        return parent::textarea($fieldName, $options);
    }

    /**
     * @param string $fieldName Name attribute of the SELECT
     * @param array|\Traversable $options Array of the OPTION elements (as 'value'=>'Text' pairs) to be used in the
     *   SELECT element
     * @param array $attributes The HTML attributes of the select element.
     * @return string Formatted SELECT element
     */
    public function select($fieldName, $options = array(), array $attributes = array()) {
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'form-control';
        }
        if ($attributes['class'] !== 'form-control') {
            $attributes['class'] = 'form-control ' . $attributes['class'];
        }
        if (isset($attributes['size'])) {
            switch ($attributes['size']) {
                case 'lg':
                    $attributes['class'] .= ' form-control-lg';
                    break;
                case 'sm':
                    $attributes['class'] .= ' form-control-sm';
                    break;
            }
            unset($attributes['size']);
        }
        return parent::select($fieldName, $options, $attributes);
    }

    /**
     * @param string|null $caption The label appearing on the button OR if string contains :// or the
     *  extension .jpg, .jpe, .jpeg, .gif, .png use an image if the extension
     *  exists, AND the first character is /, image is relative to webroot,
     *  OR if the first character is not /, image is relative to webroot/img.
     * @param array $options Array of options. See above.
     * @return string A HTML submit button
     */
    public function submit($caption = null, array $options = array()) {
        $options['class'] = isset($options['class']) ? 'btn btn-primary ' . isset($options['class']) : 'btn btn-primary';
        if (isset($options['size'])) {
            switch ($options['size']) {
                case 'lg':
                    $options['class'] .= ' btn-lg';
                    break;
                case 'sm':
                    $options['class'] .= ' btn-sm';
                    break;
            }
            unset($options['size']);
        }
        if (isset($options['block'])) {
            if ($options['block']) {
                $options['class'] .= ' btn-block';
            }
            unset($options['block']);
        }
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::submit($caption, $options);
    }

    /**
     * @param string $title The button's caption. Not automatically HTML encoded
     * @param array $options Array of options and HTML attributes.
     * @return string A HTML button tag.
     */
    public function button($title, array $options = array()) {
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::button($title, $options);
    }

    /**
     * @param string $field A field name, like "modelname.fieldname"
     * @param string|array|null $text Error message as string or array of messages. If an array,
     *   it should be a hash of key names => messages.
     * @param array $options See above.
     * @return string Formatted errors or ''.
     */
    public function error($field, $text = null, array $options = array()) {
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::error($field, $text, $options);
    }

    /**
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     */
    public function postLink($title, $url = null, array $options = array()) {
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::postLink($title, $url, $options);
    }

    /**
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     */
    public function postLinkRedirect($title, $url = null, array $options = array()) {
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
        if (!isset($options['data-toggle'])) {
            $options['data-toggle'] = 'tooltip';
        }
        if (!isset($options['data-placement'])) {
            $options['data-placement'] = 'top';
        }
        return $this->postLink($title, $url, $options);
    }

}
