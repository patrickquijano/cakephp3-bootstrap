<?php

namespace Bootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\FormHelper;

/**
 * Bootstrap Form Helper
 */
class BootstrapFormHelper extends FormHelper {

    /**
     * The template used
     *
     * @var string
     */
    private $_template = 'default';

    /**
     * Template set
     *
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
            'checkboxContainer' => '<div class="form-group">{{content}}</div>',
            'checkboxContainerError' => '<div class="form-group">{{content}}</div>',
            'checkboxFormGroup' => '{{label}}{{error}}',
            'checkboxWrapper' => '{{label}}',
            'error' => '<div class="invalid-feedback">{{content}}</div>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}{{preInputGroup}}{{prependInputGroup}}{{input}}{{appendInputGroup}}{{error}}{{postInputGroup}}{{help}}',
            'nestingLabel' => '<div class="form-check{{checkInline}}">{{input}}<label class="form-check-label"{{attrs}}>{{text}}</label></div>',
            'radioContainer' => '<div class="form-group">{{content}}</div>',
            'radioContainerError' => '<div class="form-group">{{content}}</div>',
            'radioFormGroup' => '{{input}}{{error}}',
            'submitContainer' => '{{content}}',
            'help' => '<small class="form-text text-muted">{{text}}</small>',
            'preInputGroup' => '<div class="input-group{{inputGroupSize}}">',
            'postInputGroup' => '</div>',
            'inputGroup' => '<span class="input-group-text">{{text}}</span>',
            'inputGroupContainer' => '<div class="{{inputGroupClass}}">{{content}}</div>',
        ],
        'horizontal' => [
            'checkboxContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'checkboxContainerError' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'checkboxFormGroup' => '{{input}}{{label}}{{error}}',
            'checkboxWrapper' => '{{label}}',
            'error' => '<div class="invalid-tooltip">{{content}}</div>',
            'inputContainer' => '<div class="form-group row">{{content}}</div>',
            'inputContainerError' => '<div class="form-group row">{{content}}</div>',
            'formGroup' => '{{label}}<div class="{{right}}">{{preInputGroup}}{{prependInputGroup}}{{input}}{{appendInputGroup}}{{error}}{{postInputGroup}}{{help}}</div>',
            'nestingLabel' => '<div class="form-check{{checkInline}}">{{input}}<label class="form-check-label"{{attrs}}>{{text}}</label></div>',
            'radioContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'radioContainerError' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'radioFormGroup' => '{{input}}{{error}}',
            'submitContainer' => '<div class="form-group row"><div class="{{left}}"></div><div class="{{right}}">{{content}}</div></div>',
            'help' => '<small class="form-text text-muted">{{text}}</small>',
            'preInputGroup' => '<div class="input-group{{inputGroupSize}}">',
            'postInputGroup' => '</div>',
            'inputGroup' => '<span class="input-group-text">{{text}}</span>',
            'inputGroupContainer' => '<div class="{{inputGroupClass}}">{{content}}</div>',
        ],
        'inline' => [
            'checkboxContainer' => '<div class="form-group">{{content}}</div>',
            'checkboxContainerError' => '<div class="form-group">{{content}}</div>',
            'checkboxFormGroup' => '{{label}}{{error}}',
            'checkboxWrapper' => '{{label}}',
            'error' => '<div class="invalid-feedback">{{content}}</div>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}}{{preInputGroup}}{{prependInputGroup}}{{input}}{{appendInputGroup}}{{error}}{{postInputGroup}}',
            'nestingLabel' => '<div class="form-check">{{input}}<label class="form-check-label"{{attrs}}>{{text}}</label></div>',
            'radioContainer' => '<div class="form-group">{{content}}</div>',
            'radioContainerError' => '<div class="form-group">{{content}}</div>',
            'radioFormGroup' => '{{input}}{{error}}',
            'submitContainer' => '{{content}}',
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
     * @param array $config
     * @return void
     */
    public function initialize(array $config) {
        $defaultConfig = [
            'errorClass' => 'is-invalid',
            'templates' => $this->_templateSet[$this->_template],
        ];
        $this->setConfig($defaultConfig);
        $this->helpers = Hash::merge($this->helpers, ['Html', 'Url']);
    }

    /**
     * Returns an HTML Bootstrap form element.
     *
     * ### Options:
     *
     * - `type` Form method defaults to autodetecting based on the form context. If
     *   the form context's isCreate() method returns false, a PUT request will be done.
     * - `method` Set the form's method attribute explicitly.
     * - `action` The controller action the form submits to, (optional). Use this option if you
     *   don't need to change the controller from the current request's controller. Deprecated since 3.2, use `url`.
     * - `url` The URL the form submits to. Can be a string or a URL array. If you use 'url'
     *    you should leave 'action' undefined.
     * - `encoding` Set the accept-charset encoding for the form. Defaults to `Configure::read('App.encoding')`
     * - `enctype` Set the form encoding explicitly. By default `type => file` will set `enctype`
     *   to `multipart/form-data`.
     * - `templates` The templates you want to use for this form. Any templates will be merged on top of
     *   the already loaded templates. This option can either be a filename in /config that contains
     *   the templates you want to load, or an array of templates to use.
     * - `context` Additional options for the context class. For example the EntityContext accepts a 'table'
     *   option that allows you to set the specific Table class the form should be based on.
     * - `idPrefix` Prefix for generated ID attributes.
     * - `valueSources` The sources that values should be read from. See FormHelper::setValueSources()
     * - `templateVars` Provide template variables for the formStart template.
     * - `template` The template to be used. Either clean, default and horizontal.
     * - `left` The left class for bootstrap horizontal form.
     * - `right` The right class for bootstrap horizontal form.
     *
     * @param mixed $context The context for which the form is being defined.
     *   Can be a ContextInterface instance, ORM entity, ORM resultset, or an
     *   array of meta data. You can use false or null to make a context-less form.
     * @param array $options An array of html attributes and options.
     * @return string An formatted opening FORM tag.
     */
    public function create($context = null, array $options = []) {
        if (!isset($options['autocomplete'])) {
            $options = Hash::merge($options, ['autocomplete' => 'off']);
        }
        if (isset($options['template'])) {
            $this->_template = $options['template'];
            $this->setTemplates($this->_templateSet[$this->_template]);
            if ($options['template'] === 'inline') {
                $options = Hash::merge($options, ['class' => 'form-inline']);
            }
            unset($options['template']);
        }
        if (isset($options['left'])) {
            $this->_horizontal = Hash::merge($this->_horizontal, ['left' => $options['left']]);
            unset($options['left']);
        }
        if (isset($options['right'])) {
            $this->_horizontal = Hash::merge($this->_horizontal, ['right' => $options['right']]);
            unset($options['right']);
        }
        return parent::create($context, $options);
    }

    /**
     * Returns a formatted error message for given form field, '' if no errors.
     *
     * Uses the `error`, `errorList` and `errorItem` templates. The `errorList` and
     * `errorItem` templates are used to format multiple error messages per field.
     *
     * ### Options:
     *
     * - `escape` boolean - Whether or not to html escape the contents of the error.
     *
     * @param string $field A field name, like "modelname.fieldname"
     * @param string|array|null $text Error message as string or array of messages. If an array,
     *   it should be a hash of key names => messages.
     * @param array $options See above.
     * @return string Formatted errors or ''.
     */
    public function error($field, $text = null, array $options = []) {
        if (!isset($options['escape'])) {
            $options = Hash::merge($options, ['escape' => false]);
        }
        return parent::error($field, $text, $options);
    }

    /**
     * Generates a form control element complete with label and wrapper div.
     *
     * ### Options
     *
     * See each field type method for more information. Any options that are part of
     * $attributes or $options for the different **type** methods can be included in `$options` for input().
     * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
     * will be treated as a regular HTML attribute for the generated input.
     *
     * - `type` - Force the type of widget you want. e.g. `type => 'select'`
     * - `label` - Either a string label, or an array of options for the label. See FormHelper::label().
     * - `options` - For widgets that take options e.g. radio, select.
     * - `error` - Control the error message that is produced. Set to `false` to disable any kind of error reporting (field
     *    error and error messages).
     * - `empty` - String or boolean to enable empty select box options.
     * - `nestedInput` - Used with checkbox and radio inputs. Set to false to render inputs outside of label
     *   elements. Can be set to true on any input to force the input inside the label. If you
     *   enable this option for radio buttons you will also need to modify the default `radioWrapper` template.
     * - `templates` - The templates you want to use for this input. Any templates will be merged on top of
     *   the already loaded templates. This option can either be a filename in /config that contains
     *   the templates you want to load, or an array of templates to use.
     * - `labelOptions` - Either `false` to disable label around nestedWidgets e.g. radio, multicheckbox or an array
     *   of attributes for the label tag. `selected` will be added to any classes e.g. `class => 'myclass'` where
     *   widget is checked
     *
     * @param string $fieldName This should be "modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     */
    public function control($fieldName, array $options = []) {
        $options = Hash::merge([
                'type' => null,
                'label' => null,
                'error' => null,
                'required' => null,
                'options' => null,
                'templates' => [],
                'templateVars' => [],
                'labelOptions' => true
                ], $options);
        $options = $this->_parseOptions($fieldName, $options);
        $class = '';
        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
                $class = 'form-check-input';
                break;
            case 'text':
            case 'email':
            case 'number':
            case 'search':
            case 'textarea':
                $class = 'form-control';
                break;
            case 'password':
                $class = 'form-control';
                $options = Hash::merge($options, ['value' => '']);
                break;
            case 'select':
                if (isset($options['multiple']) && $options['multiple'] === 'checkbox') {
                    $class = 'form-check-input';
                } else {
                    $class = 'form-control';
                }
                break;
            case 'submit':
                $class = 'btn btn-primary';
                break;
        }
        if (isset($options['class'])) {
            if ($options['type'] !== 'submit') {
                $class .= ' ' . $options['class'];
            } else {
                $class = $options['class'];
            }
        }
        if (!empty($class)) {
            $options = Hash::merge($options, ['class' => $class]);
        }
        if (isset($options['checkInline'])) {
            if ($options['checkInline']) {
                $options = Hash::merge($options, ['templateVars' => ['checkInline' => ' form-check-inline']]);
            }
            unset($options['formCheckInline']);
        }
        if (!empty($options['help'])) {
            $options = Hash::merge($options, ['templateVars' => ['help' => $this->templater()->format('help', ['text' => $options['help']])]]);
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
            if (isset($options) && is_string($options['label'])) {
                $options = Hash::merge($options, ['label' => ['text' => $options['label']]]);
            }
            if (!in_array($options['type'], ['checkbox', 'radio'])) {
                $options = Hash::merge($options, ['label' => ['class' => $this->_horizontal['left'] . ' col-form-label']]);
            }
            $options = Hash::merge($options, ['templateVars' => [
                        'left' => $this->_horizontal['left'],
                        'right' => $this->_horizontal['right'],
            ]]);
        }
        return parent::control($fieldName, $options);
    }

    /**
     * Creates an HTML link, but access the URL using the method you specify
     * (defaults to POST). Requires javascript to be enabled in browser.
     *
     * This method creates a `<form>` element. If you want to use this method inside of an
     * existing form, you must use the `block` option so that the new form is being set to
     * a view block that can be rendered outside of the main form.
     *
     * If all you are looking for is a button to submit your form, then you should use
     * `FormHelper::button()` or `FormHelper::submit()` instead.
     *
     * ### Options:
     *
     * - `data` - Array with key/value to pass in input hidden
     * - `method` - Request method to use. Set to 'delete' to simulate
     *   HTTP/1.1 DELETE request. Defaults to 'post'.
     * - `confirm` - Confirm message to show. Form execution will only continue if confirmed then.
     * - `block` - Set to true to append form to view block "postLink" or provide
     *   custom block name.
     * - `includeRedirect` Includes a redirect query param for the current url.
     * - Other options are the same of HtmlHelper::link() method.
     * - The option `onclick` will be replaced.
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     */
    public function postLink($title, $url = null, array $options = []) {
        if (isset($options['includeRedirect']) && $options['includeRedirect'] === true) {
            $redirect = urlencode($this->Url->build(null, ['escape' => false]));
            if (is_array($url)) {
                $url = Hash::merge($url, ['?' => ['redirect' => $redirect]]);
            }
            unset($options['includeRedirect']);
        }
        if (!isset($options['data-toggle'])) {
            $options = Hash::merge($options, ['data-toggle' => 'tooltip']);
        }
        return parent::postLink($title, $url, $options);
    }

    /**
     * An extension of postLink method. Generates a postLink for Bootstrap nav item.
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $optionsLink Array of options and HTML attributes for the link.
     * @param array $optionsList Additional HTML attributes of the li tag.
     * @return string An `<a />` element.
     */
    public function postLinkNavItem($title, $url = null, array $optionsLink = [], array $optionsList = []) {
        $linkClass = 'nav-link';
        if (isset($optionsLink['class'])) {
            $linkClass .= ' ' . $optionsLink['class'];
        }
        $optionsLink = Hash::merge($optionsLink, ['class' => $linkClass]);
        $listClass = 'nav-item';
        if (isset($optionsList['class'])) {
            $listClass .= ' ' . $optionsList['class'];
        }
        $optionsList = Hash::merge($optionsList, ['class' => $listClass]);
        return $this->Html->tag($title, $this->postLink($title, $url, $optionsLink), $optionsList);
    }

    /**
     * An extension of postLink method. Generates a postLink for Bootstrap nav dropdown item.
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     */
    public function postLinkNavDropdownItem($title, $url = null, array $options = []) {
        $class = 'dropdown-item';
        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $options = Hash::merge($options, ['class' => $class]);
        return parent::postLink($title, $url, $options);
    }

    /**
     * Builds the Bootstrap input group.
     *
     * @param string $inputGroupType Either prepend or append.
     * @param array $options
     * @return string
     */
    protected function _buildInputGroup($inputGroupType, array $options = []) {
        $class = null;
        $text = $options[$inputGroupType];
        $button = null;
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
        }
        $inputGroupSize = $class !== null ? ['inputGroupSize' => $class] : [];
        $options = Hash::merge($options, ['templateVars' => [
                    'preInputGroup' => $this->templater()->format('preInputGroup', $inputGroupSize),
                    'postInputGroup' => $this->templater()->format('postInputGroup', []),
        ]]);
        $content = '';
        if (!empty($text)) {
            if (is_array($text)) {
                foreach ($text as $t) {
                    $content .= $this->templater()->format('inputGroup', ['text' => $t]);
                }
            } else {
                $content .= $this->templater()->format('inputGroup', ['text' => $text]);
            }
        }
        if ($button !== null) {
            if (is_array($button)) {
                foreach ($button as $b) {
                    $content .= $b;
                }
            } else {
                $content .= $button;
            }
        }
        $options = Hash::merge($options, ['templateVars' => [$inputGroupType . 'InputGroup' => $this->templater()->format('inputGroupContainer', [
                        'inputGroupClass' => 'input-group-' . $inputGroupType,
                        'content' => $content
        ])]]);
        return $options;
    }

}
