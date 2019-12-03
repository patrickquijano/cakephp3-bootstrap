<?php

namespace Bootstrap\View\Helper;

use Cake\View\Helper\PaginatorHelper;

class BootstrapPaginatorHelper extends PaginatorHelper {

    /**
     * @param array $config
     * @return void
     */
    public function initialize(array $config) {
        $defaultConfig = [
            'templates' => [
                'nextActive' => '<li class="page-item"><a class="page-link" rel="next" aria-label="Next" href="{{url}}"><span aria-hidden="true">{{text}}</span></a></li>',
                'nextDisabled' => '<li class="page-item disabled"><span class="page-link" aria-hidden="true">{{text}}</span></li>',
                'prevActive' => '<li class="page-item"><a class="page-link" rel="prev" aria-label="Previous" href="{{url}}"><span aria-hidden="true">{{text}}</span></a></li>',
                'prevDisabled' => '<li class="page-item disabled"><span class="page-link" aria-hidden="true">{{text}}</span></a></li>',
                'first' => '<li class="page-item"><a class="page-link" aria-label="First" href="{{url}}">{{text}}</a></li>',
                'last' => '<li class="page-item"><a class="page-link" aria-label="Last" href="{{url}}">{{text}}</a></li>',
                'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'current' => '<li class="page-item active"><span class="page-link">{{text}}</span> <span class="sr-only">(current)</span></li>',
                'ellipsis' => '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>',
            ],
        ];
        $this->setConfig($defaultConfig);
    }

    /**
     * @param array $options
     * @return string
     */
    public function paginate(array $options = array()) {
        $size = '';
        if (isset($options['size'])) {
            $size = ' pagination-' . $options['size'];
            unset($options['size']);
        }
        $alignment = '';
        if (isset($options['alignment'])) {
            $size = ' justify-content-' . $options['alignment'];
            unset($options['alignment']);
        }
        $options['first'] = 2;
        $options['last'] = 2;
        $options['modulus'] = 5;
        $numbers = $this->numbers($options);
        if ($numbers) {
            $out = '<ul class="pagination' . $size . $alignment . '">';
            $out .= $this->first(__('First')) . $this->prev(__('Previous'));
            $out .= $numbers;
            $out .= $this->next(__('Next')) . $this->last(__('Last'));
            $out .= '</ul>';
            return $out;
        }
        return null;
    }

}
