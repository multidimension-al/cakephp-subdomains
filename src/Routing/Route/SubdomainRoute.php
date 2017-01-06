<?php
/**
 * CakePHP Plugin : CakePHP Subdomain Routing
 * Copyright (c) Multidimension.al (http://multidimension.al)
 * Github : https://github.com/multidimension-al/cakephp-subdomains
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     (c) Multidimension.al (http://multidimension.al)
 * @link          https://github.com/multidimension-al/cakephp-subdomains Github
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Multidimensional\Subdomains\Routing\Route;

use Cake\Routing\Router;
use Cake\Network\Request;
use Cake\Routing\Route\Route;

use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

class SubdomainRoute extends Route {
        
    public function parse($url, $method = '') {

        list($prefix) = $this->_getPrefixAndHost();

        if (!$this->_checkPrefix($prefix)) {
            return false;
        }

        return parent::parse($url, $method);

    }

    public function match(array $url, array $context = []) {

        if (!isset($url['prefix'])) {
            $url['prefix'] = false;
        }
        
        if (!$this->_checkPrefix($url['prefix'])) {
            return false;
        }

        list($prefix, $host) = $this->_getPrefixAndHost($context);

        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === false ? $host : $url['prefix'] . '.' . $host;
        }
        
        return parent::match($url, $context);

    }

    private function _getPrefixAndHost(array $context = []) {

        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::createFromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }
        
        $subdomainObject = new SubdomainMiddleware();
        return $subdomainObject->getPrefixAndHost($host);
        
    }

    private function _checkPrefix($prefix) {

        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : false;

        return $prefix === $routePrefix;

    }
        
}