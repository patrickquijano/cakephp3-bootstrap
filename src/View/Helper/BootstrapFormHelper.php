<?php

namespace Bootstrap\View\Helper;

use Cake\View\Helper\FormHelper;

/**
 * @method \Bootstrap\View\Helper\BootstrapHtmlHelper $BootstrapHtml
 */
class BootstrapFormHelper extends FormHelper {

    /**
     * @var string
     */
    private $_template = 'default';

    /**
     * @var array
     */
    private $_templateSet = [
        'clean' => [
            'checkboxContainer' => '{{content}}',
            'error' => '<div class="invalid-feedback">{{content}}</div>',
            'inputContainer' => '{{content}}',
            'inputContainerError' => '{{content}}{{error}}',
            'submitContainer' => '{{content}}',
            'help' => '<small class="form-text text-muted">{{text}}</small>',
        ],
        'default' => [
            'checkboxContainer' => '<div class="form-group"><div class="form-check">{{content}}</div></div>',
            'checkboxContainerError' => '<div class="form-group"><div class="form-check">{{content}}</div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}{{error}}',
            'error' => '<div class="invalid-feedback">{{content}}</div>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group">{{content}}{{error}}</div>',
            'formGroup' => '{{label}}{{preInputGroup}}{{prependInputGroup}}{{input}}{{appendInputGroup}}{{error}}{{postInputGroup}}{{help}}',
            'radioContainer' => '<div class="form-group"><div class="form-check">{{content}}</div></div>',
            'radioContainerError' => '<div class="form-group"><div class="form-check">{{content}}</div></div>',
            'radioFormGroup' => '{{input}}{{label}}{{error}}',
            'submitContainer' => '{{content}}',
            'help' => '<small class="form-text text-muted">{{text}}</small>',
            'preInputGroup' => '<div class="input-group{{inputGroupSize}}">',
            'postInputGroup' => '</div>',
            'inputGroup' => '<span class="input-group-text">{{text}}</span>',
            'inputGroupContainer' => '<div class="{{inputGroupClass}}">{{content}}</div>',
        ],
        'horizontal' => [
            'checkboxContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}"><div class="form-check">{{content}}</div></div></div>',
            'checkboxContainerError' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}"><div class="form-check">{{content}}</div></div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}{{error}}',
            'error' => '<div class="invalid-tooltip">{{content}}</div>',
            'inputContainer' => '<div class="form-group row">{{content}}</div>',
            'inputContainerError' => '<div class="form-group row">{{content}}</div>',
            'formGroup' => '{{label}}<div class="{{right}}">{{preInputGroup}}{{prependInputGroup}}{{input}}{{appendInputGroup}}{{error}}{{postInputGroup}}{{help}}</div>',
            'radioContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}"><div class="form-check">{{content}}</div></div></div>',
            'radioContainerError' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}"><div class="form-check">{{content}}</div></div></div>',
            'radioFormGroup' => '{{input}}{{label}}{{error}}',
            'submitContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'help' => '<small class="form-text text-muted">{{text}}</small>',
            'preInputGroup' => '<div class="input-group{{inputGroupSize}}">',
            'postInputGroup' => '</div>',
            'inputGroup' => '<span class="input-group-text">{{text}}</span>',
            'inputGroupContainer' => '<div class="{{inputGroupClass}}">{{content}}</div>',
        ],
    ];

    /**
     * @var array
     */
    private $_horizontal = [
        'left' => 'col-sm-2',
        'right' => 'col-sm-10',
    ];

    /**
     * @var array
     */
    public $helpers = ['BootstrapHtml'];

    /**
     * @param array $config
     * @return void
     */
    public function initialize(array $config) {
        $defaultConfig = [
            'errorClass' => 'is-invalid',
            'templates' => $this->_templateSet[$this->_template],
        ];
        $this->setConfig($defaultConfig);
    }

    /**
     * @param mixed $context
     * @param array $options
     * @return string
     */
    public function create($context = null, array $options = []) {
        if (!isset($options['autocomplete'])) {
            $options['autocomplete'] = 'off';
        }
        if (isset($options['template'])) {
            $this->_template = $options['template'];
            $this->setTemplates($this->_templateSet[$this->_template]);
            unset($options['template']);
        }
        if (isset($options['left'])) {
            $this->_horizontal['left'] = $options['left'];
            unset($options['left']);
        }
        if (isset($options['right'])) {
            $this->_horizontal['right'] = $options['right'];
            unset($options['right']);
        }
        return parent::create($context, $options);
    }

    /**
     * @param string $field
     * @param string|array|null $text
     * @param array $options
     * @return string
     */
    public function error($field, $text = null, array $options = []) {
        if (!isset($options['escape'])) {
            $options['escape'] = false;
        }
        return parent::error($field, $text, $options);
    }

    /**
     * @param string $fieldName
     * @param string|null $text
     * @param array $options
     * @return string
     */
    public function label($fieldName, $text = null, array $options = []) {
        return parent::label($fieldName, $text, $options);
    }

    /**
     * @param string $fieldName
     * @param array $options
     * @return string
     */
    public function control($fieldName, array $options = []) {
        $options += [
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'templates' => [],
            'templateVars' => [],
            'labelOptions' => true
        ];
        $options = $this->_parseOptions($fieldName, $options);
        if (!empty($options['help'])) {
            $options['templateVars']['help'] = $this->templater()->format('help', ['text' => $options['help']]);
            unset($options['help']);
        }
        if (isset($options['prepend'])) {
            $options = $this->_buildInputGroup('prepend', $options);
            unset($options['prepend']);
        }
        if (isset($options['append'])) {
            $options = $this->_buildInputGroup('append', $options);
            unset($options['append']);
        }
        if ($this->_template === 'horizontal') {
            $options['label']['class'] = $this->_horizontal['left'] . ' col-form-label';
            $options['templateVars']['left'] = $this->_horizontal['left'];
            $options['templateVars']['right'] = $this->_horizontal['right'];
        }
        return parent::control($fieldName, $options);
    }

    /**
     * @param string $fieldName
     * @param array $options
     * @return string|array
     */
    public function checkbox($fieldName, array $options = []) {
        if (!isset($options['class'])) {
            $options['class'] = 'form-check-input';
        }
        return parent::checkbox($fieldName, $options);
    }

    /**
     * @param string $fieldName
     * @param array|\Traversable $options
     * @param array $attributes
     */
    public function radio($fieldName, $options = [], array $attributes = []) {
        if (!isset($options['class'])) {
            $options['class'] = 'form-check-input';
        }
        return parent::radio($fieldName, $options, $attributes);
    }

    /**
     *
     * @param string $method
     * @param array $params
     * @return string
     */
    public function __call($method, $params) {
        if (in_array($method, ['text', 'number', 'email', 'password', 'search'])) {
            if (!isset($params[1]['class'])) {
                $params[1]['class'] = 'form-control';
            }
        }
        if (isset($params[1]['help'])) {
            $params[1]['templateVars']['help'] = $this->templater()->format('help', ['text' => $params[1]['help']]);
            unset($params[1]['help']);
        }
        return parent::__call($method, $params);
    }

    /**
     * @param string $fieldName
     * @param array $options
     * @return string
     */
    public function textarea($fieldName, array $options = []) {
        if (!isset($options['class'])) {
            $options['class'] = 'form-control';
        }
        return parent::textarea($fieldName, $options);
    }

    /**
     * @param string $fieldName
     * @param array|\Traversable $options
     * @param array $attributes
     * @return string
     */
    public function submit($caption = null, array $options = []) {
        if (!isset($options['class'])) {
            $options['class'] = 'btn btn-primary';
        }
        if ($this->_template === 'horizontal') {
            $options['templateVars']['left'] = $this->_horizontal['left'];
            $options['templateVars']['right'] = $this->_horizontal['right'];
        }
        return parent::submit($caption, $options);
    }

    /**
     * @param string $fieldName
     * @param array|\Traversable $options
     * @param array $attributes
     * @return string
     */
    public function select($fieldName, $options = [], array $attributes = []) {
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'form-control';
        }
        return parent::select($fieldName, $options, $attributes);
    }

    /**
     * @param string $title
     * @param string|array|null $url
     * @param array $options
     * @return string
     */
    public function postLinkNavItem($title, $url = null, array $optionsLink = [], array $optionsList = []) {
        $optionsLink['class'] = 'nav-link';
        $optionsList['class'] = 'nav-item';
        return $this->BootstrapHtml->tag($title, $this->postLink($title, $url, $optionsLink), $optionsList);
    }

    /**
     * @param string $title
     * @param string|array|null $url
     * @param array $options
     * @return string
     */
    public function postLinkNavDropdownItem($title, $url = null, array $options = []) {
        $options['class'] = 'dropdown-item';
        return parent::postLink($title, $url, $options);
    }

    /**
     * @param string $title
     * @param string|array|null $url
     * @param array $options
     * @return string
     */
    public function postLinkRedirect($title, $url = null, array $options = []) {
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

    /**
     * @param string $inputGroupType
     * @param array $options
     * @return string
     */
    protected function _buildInputGroup($inputGroupType, array $options = []) {
        if (is_array($options[$inputGroupType])) {
            if (isset($options[$inputGroupType]['class'])) {
                $class = ' ' . $options[$inputGroupType]['class'];
            }
            if (isset($options[$inputGroupType]['text'])) {
                $text = $options[$inputGroupType]['text'];
            }
            if (isset($options[$inputGroupType]['button'])) {
                $button = $options[$inputGroupType]['button'];
            }
        } else {
            $class = null;
            $text = $options[$inputGroupType];
            $button = null;
        }
        $inputGroupClass = !empty($class) ? ['inputGroupClass' => $class] : [];
        $options['templateVars']['preInputGroup'] = $this->templater()->format('preInputGroup', $inputGroupClass);
        $options['templateVars']['postInputGroup'] = $this->templater()->format('postInputGroup', []);
        $content = '';
        if (is_array($text)) {
            foreach ($text as $t) {
                $content .= $this->templater()->format('inputGroup', ['text' => $t]);
            }
        } else {
            $content .= $this->templater()->format('inputGroup', ['text' => $text]);
        }
        if (!empty($button)) {
            if (is_array($button)) {
                foreach ($button as $b) {
                    $content .= $b;
                }
            } else {
                $content .= $button;
            }
        }
        $options['templateVars'][$inputGroupType . 'InputGroup'] = $this->templater()->format('inputGroupContainer', [
            'inputGroupClass' => 'input-group-' . $inputGroupType,
            'content' => $content
        ]);
        return $options;
    }

}
