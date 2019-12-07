<?php

namespace Bootstrap\View\Helper;

use Cake\View\Helper\UrlHelper;

class BootstrapUrlHelper extends UrlHelper {

    /**
     * @param string|array $url
     * @return string
     */
    public function redirect($url) {
        $redirect = $this->getView()->getRequest()->getQuery('redirect');
        if (!empty($redirect)) {
            return urldecode($redirect);
        }
        return $url;
    }

}
